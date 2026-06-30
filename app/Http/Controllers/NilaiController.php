<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;
use App\Models\Tugas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mp;
use App\Models\GuruMengajar;

class NilaiController extends Controller
{
    public function showInput(Request $request)
    {
        $guru = Auth::user();

        // Only show MPs this teacher teaches
        $myMps = Mp::whereIn('id',
            GuruMengajar::where('user_id', $guru->id)->pluck('mp_id')->unique()
        )->get();

        // Only show kelas this teacher teaches
        $myKelas = Kelas::whereIn('id',
            GuruMengajar::where('user_id', $guru->id)->pluck('kelas_id')->unique()
        )->orderBy('nomor_kelas')->orderBy('huruf_kelas')->get();

        // Selected values from URL params (default to first available)
        $selectedMpId    = $request->input('mp_id',    $myMps->first()?->id);
        $selectedKelasId = $request->input('kelas_id', $myKelas->first()?->id);
        $selectedTugasId = $request->input('tugas_id');

        // Tugas filtered by selected MP
        $tugasList = $selectedMpId
            ? Tugas::where('mp_id', $selectedMpId)->get()
            : collect();

        if (!$selectedTugasId) {
            $selectedTugasId = $tugasList->first()?->id;
        }

        // Students in selected class with their score for selected task
        $siswas = collect();
        if ($selectedKelasId) {
            $siswas = Siswa::where('kelas_id', $selectedKelasId)
                ->orderBy('nama')
                ->get()
                ->map(function ($siswa) use ($selectedTugasId) {
                    $siswa->nilai = $selectedTugasId
                        ? Nilai::where('siswa_id', $siswa->id)
                               ->where('tugas_id', $selectedTugasId)
                               ->first()
                        : null;
                    return $siswa;
                });
        }

        return view('pages.guru.input-nilai', compact(
            'myMps', 'myKelas', 'tugasList',
            'siswas',
            'selectedMpId', 'selectedKelasId', 'selectedTugasId',
        ));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tugas_id' => 'required|exists:tugas,id',
            'nilai'    => 'required|numeric|min:0|max:100',
        ]);

        Nilai::updateOrCreate(
            [
                'siswa_id' => $request->siswa_id,
                'tugas_id' => $request->tugas_id,
            ],
            [
                'nilai'   => $request->nilai,
                'user_id' => Auth::id(),
            ]
        );

        return response()->json(['success' => true]);
    }

    public function showRekap(Request $request)
    {
        $guru = Auth::user();

        // Only show MPs this teacher teaches
        $myMps = Mp::whereIn('id',
            GuruMengajar::where('user_id', $guru->id)->pluck('mp_id')->unique()
        )->get();

        // Only show kelas this teacher teaches
        $myKelas = Kelas::whereIn('id',
            GuruMengajar::where('user_id', $guru->id)->pluck('kelas_id')->unique()
        )->orderBy('nomor_kelas')->orderBy('huruf_kelas')->get();

        // Selected values from URL params (default to first available)
        $selectedMpId    = $request->input('mp_id',    $myMps->first()?->id);
        $selectedKelasId = $request->input('kelas_id', $myKelas->first()?->id);

        // Tugas filtered by selected MP
        $tugasList = $selectedMpId
            ? Tugas::where('mp_id', $selectedMpId)
                   ->orderByRaw("FIELD(tipe, 'Tugas', 'UH', 'UTS', 'UAS')")
                   ->orderBy('nama')
                   ->get()
            : collect();

        // Students in selected class with their score for selected task
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

        // Class-wide average (only students who have at least one score)
        $classAverage = $siswas
            ->filter(fn($s) => $s->rata_rata !== null)
            ->avg('rata_rata');
        $classAverage = $classAverage ? round($classAverage, 1) : null;

        return view('pages.guru.rekap-nilai', compact(
            'myMps', 'myKelas', 'tugasList',
            'siswas', 'selectedMpId', 'classAverage', 'selectedKelasId',
        ));
    }
}
