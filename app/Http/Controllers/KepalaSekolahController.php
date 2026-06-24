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
            ? Siswa::where('kelas_id', $selectedKelasId)   // ← uses selectedKelasId
                   ->orderBy('nama')
                   ->get()
                   ->map(function ($siswa) use ($tugasList) {
                       $scores = [];
                       $filled = 0;
                       $total  = 0;

                       foreach ($tugasList as $tugas) {
                           $nilai = Nilai::where('siswa_id', $siswa->id)
                                        ->where('tugas_id', $tugas->id)
                                        ->value('nilai');
                           $scores[$tugas->id] = $nilai;
                           if ($nilai !== null) {
                               $total += $nilai;
                               $filled++;
                           }
                       }

                       $siswa->scores    = $scores;
                       $siswa->rata_rata = $filled > 0
                           ? round($total / $filled, 1)
                           : null;

                       return $siswa;
                   })
            : collect();

        return view('pages.kepala-sekolah.penilaian-siswa', compact(
            'allKelas', 'allMps', 'tugasList', 'siswas',
            'selectedKelasId', 'selectedMpId'
        ));
    }
}
