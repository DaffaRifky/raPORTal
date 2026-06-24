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
        $k                = new Kelas;
        $k->nomor_kelas   = $request->input('nomor_kelas');
        $k->huruf_kelas   = strtoupper($request->input('huruf_kelas'));
        $k->wali_kelas_id = $request->input('wali_kelas_id') ?: null;
        $k->save();

        return redirect()->back()->with('success', 'Kelas berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $k                = Kelas::findOrFail($id);
        $k->nomor_kelas   = $request->input('nomor_kelas');
        $k->huruf_kelas   = strtoupper($request->input('huruf_kelas'));
        $k->wali_kelas_id = $request->input('wali_kelas_id') ?: null;
        $k->save();

        return redirect()->back()->with('success', 'Kelas berhasil diperbarui');
    }

    public function delete($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Kelas berhasil dihapus');
    }
}