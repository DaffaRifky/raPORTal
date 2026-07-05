<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Nilai;
use App\Models\Mp;

class WaliKelasController extends Controller
{
    public function kelas_saya(Request $request)
    {
        $guru  = Auth::user();

        // Find the class this teacher is wali kelas of
        $kelas = Kelas::where('wali_kelas_id', $guru->id)->first();

        // If not a wali kelas, show empty state
        if (!$kelas) {
            return view('pages.wali-kelas.kelas-saya', ['kelas' => null]);
        }

        // All MPs that have at least one tugas (so the dropdown is useful)
        $allMps = Mp::whereHas('tugas')->orderBy('nama')->get();

        $selectedMpId = $request->input('mp_id', $allMps->first()?->id);

        // Tasks for selected MP, ordered by type then name
        $tugasList = $selectedMpId
            ? Tugas::where('mp_id', $selectedMpId)
                   ->orderByRaw("FIELD(tipe, 'Tugas', 'UH', 'UTS', 'UAS')")
                   ->orderBy('nama')
                   ->get()
            : collect();

        // Students in this class, each with their scores per task
        $siswas = Siswa::where('kelas_id', $kelas->id)
            ->orderBy('nama')
            ->get()
            ->map(function ($siswa) use ($tugasList) {
                $scores       = [];
                $totalTugas   = 0;
                $countTugas   = 0;
                $nilaiUts     = 0;
                $nilaiUas     = 0;
                $hasUts       = false;
                $hasUas       = false;

                foreach ($tugasList as $tugas) {
                    $nilai = Nilai::where('siswa_id', $siswa->id)
                                 ->where('tugas_id', $tugas->id)
                                 ->value('nilai');

                    $scores[$tugas->id] = $nilai;

                    if ($nilai !== null) {
                        // Kelompokkan berdasarkan tipe tugas
                        if ($tugas->tipe === 'Tugas') {
                            $totalTugas += $nilai;
                            $countTugas++;
                        } elseif ($tugas->tipe === 'UTS') {
                            $nilaiUts = $nilai;
                            $hasUts = true;
                        } elseif ($tugas->tipe === 'UAS') {
                            $nilaiUas = $nilai;
                            $hasUas = true;
                        }
                    }
                }

                $rataTugas = ($countTugas > 0) ? ($totalTugas / $countTugas) : 0;


                $bobotTugas = 0.60;
                $bobotUts   = 0.20;
                $bobotUas   = 0.20;

                $finalScore = 0;

                $finalScore += ($rataTugas * $bobotTugas);
                $finalScore += ($hasUts ? ($nilaiUts * $bobotUts) : 0);
                $finalScore += ($hasUas ? ($nilaiUas * $bobotUas) : 0);


                $siswa->scores    = $scores;
                $siswa->rata_rata = $finalScore > 0 ? round($finalScore, 1) : null;

                           return $siswa;
                       });

        // Class-wide average (only students who have at least one score)
        $classAverage = $siswas
            ->filter(fn($s) => $s->rata_rata !== null)
            ->avg('rata_rata');
        $classAverage = $classAverage ? round($classAverage, 1) : null;

        return view('pages.wali-kelas.kelas-saya', compact(
            'kelas', 'siswas', 'tugasList', 'allMps',
            'selectedMpId', 'classAverage'
        ));
    }

    // report card page
     public function rapor(Request $request)
    {
        $guru  = Auth::user();
        $kelas = Kelas::where('wali_kelas_id', $guru->id)->first();

        if (!$kelas) {
            return view('pages.wali-kelas.rapor', ['kelas' => null]);
        }

        // ── 1. Students for the dropdown ─────────────────────
        // IMPORTANT: include 'id' — needed to look up Nilai rows.
        $siswas = Siswa::where('kelas_id', $kelas->id)
            ->orderBy('nama')
            ->select('id', 'nis', 'nama')
            ->get();

        // ── 2. Which student is selected? ────────────────────
        $selectedNis   = $request->input('nis', $siswas->first()?->nis);
        $selectedSiswa = $siswas->firstWhere('nis', $selectedNis);

        // ── 3. All subjects that have at least one assignment ─
        $allMps = Mp::whereHas('tugas')->orderBy('nama')->get();

        // ── 4. Calculate score per MP for the selected student ─
        //
        // Load all assignments and all scores in just 2 queries
        // (avoids N×M queries inside the loop).
        $allTugas = Tugas::whereIn('mp_id', $allMps->pluck('id'))
            ->get()
            ->groupBy('mp_id');          // keyed by mp_id

        $allNilai = $selectedSiswa
            ? Nilai::where('siswa_id', $selectedSiswa->id)
                   ->pluck('nilai', 'tugas_id')  // [ tugas_id => nilai ]
            : collect();

        $mpScores = [];

        foreach ($allMps as $mp) {
            $tugasForMp = $allTugas->get($mp->id, collect());

            $totalTugas = 0;
            $countTugas = 0;
            $nilaiUts   = 0;
            $nilaiUas   = 0;
            $hasUts     = false;
            $hasUas     = false;

            foreach ($tugasForMp as $tugas) {
                $nilai = $allNilai->get($tugas->id);

                if ($nilai === null) continue;

                if (in_array($tugas->tipe, ['Tugas', 'UH'])) {
                    $totalTugas += $nilai;
                    $countTugas++;
                } elseif ($tugas->tipe === 'UTS') {
                    $nilaiUts = $nilai;
                    $hasUts   = true;
                } elseif ($tugas->tipe === 'UAS') {
                    $nilaiUas = $nilai;
                    $hasUas   = true;
                }
            }

            $rataTugas  = $countTugas > 0 ? $totalTugas / $countTugas : 0;
            $finalScore = ($rataTugas  * 0.60)
                        + ($hasUts ? $nilaiUts * 0.20 : 0)
                        + ($hasUas ? $nilaiUas * 0.20 : 0);

            $finalScore = $finalScore > 0 ? round($finalScore, 1) : null;

            $mpScores[$mp->id] = [
                'rata_rata' => $finalScore,
                'predikat'  => $finalScore !== null ? self::predikat($finalScore) : '-',
            ];
        }

        return view('pages.wali-kelas.rapor', compact(
            'kelas', 'siswas', 'allMps', 'selectedSiswa', 'selectedNis', 'mpScores'
        ));
    }

    // ── Predikat helper ──────────────────────────────────────
    private static function predikat(float $score): string
    {
        return match (true) {
            $score >= 85 => 'A',
            $score >= 70 => 'B',
            $score >= 55 => 'C',
            $score >= 40 => 'D',
            default      => 'E',
        };
    }
}
