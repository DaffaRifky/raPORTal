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
