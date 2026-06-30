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
    public function index(Request $request)
    {
        $guru  = Auth::user();

        // Find the class this teacher is wali kelas of
        $kelas = Kelas::where('wali_kelas_id', $guru->id)->first();

        // If not a wali kelas, show empty state
        if (!$kelas) {
            return view('pages.guru.kelas-saya', ['kelas' => null]);
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
}
