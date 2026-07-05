<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class KelasController extends Controller
{
    public function show()
    {
        $kelas = Kelas::with(['siswas', 'waliKelas'])
                      ->orderBy('nomor_kelas')
                      ->orderBy('huruf_kelas')
                      ->get();

        $gurus = User::where('role', 'Guru')
                     ->orderBy('nama')
                     ->get();

        return view('pages.adminTU.data-kelas', compact('kelas', 'gurus'));
    }

    public function simpan(Request $request)
    {

        kelas::create([
            'nomor_kelas'   => $request->input('nomor_kelas'),
            'huruf_kelas'   => strtoupper($request->input('huruf_kelas')),
            'wali_kelas_id' => $request->input('wali_kelas_id') ?: null,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        Kelas::where('id', $id)->update([
            'nomor_kelas'   => $request->input('nomor_kelas'),
            'huruf_kelas'   => strtoupper($request->input('huruf_kelas')),
            'wali_kelas_id' => $request->input('wali_kelas_id') ?: null,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil diperbarui');
    }

    public function delete($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Kelas berhasil dihapus');
    }
}