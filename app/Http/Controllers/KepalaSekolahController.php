<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Nilai;
use App\Models\Mp;

class KepalaSekolahController extends Controller
{
    public function index(Request $request)
    {
        // All kelas and MPs for the dropdowns
        $allKelas = Kelas::with('siswas')                   // ← 'siswas' not 'siswa'
                         ->orderBy('nomor_kelas')
                         ->orderBy('huruf_kelas')
                         ->get();

        $allMps = Mp::whereHas('tugas')->orderBy('nama')->get();

        // Selected values — default to first available
        $selectedKelasId = $request->input('kelas_id', $allKelas->first()?->id);
        $selectedMpId    = $request->input('mp_id',    $allMps->first()?->id);

        // Tasks for selected MP
        $tugasList = $selectedMpId
            ? Tugas::where('mp_id', $selectedMpId)
                   ->orderByRaw("FIELD(tipe, 'Tugas', 'UH', 'UTS', 'UAS')")
                   ->orderBy('nama')
                   ->get()
            : collect();

        // Students in selected class with their scores
        $siswas = $selectedKelasId
        ? Siswa::where('kelas_id', $selectedKelasId)
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
                   })
            : collect();

        return view('pages.kepala-sekolah.penilaian-siswa', compact(
            'allKelas', 'allMps', 'tugasList', 'siswas',
            'selectedKelasId', 'selectedMpId'
        ));
    }
}
