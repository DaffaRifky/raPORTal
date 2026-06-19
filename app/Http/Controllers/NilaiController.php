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
    public function show(Request $request)
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
        $selectedMpId    = $request->get('mp_id',    $myMps->first()?->id);
        $selectedKelasId = $request->get('kelas_id', $myKelas->first()?->id);
        $selectedTugasId = $request->get('tugas_id');

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
            'selectedMpId', 'selectedKelasId', 'selectedTugasId'
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
}
