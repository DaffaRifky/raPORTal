<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;

class SiswaController extends Controller
{
    public function simpan(Request $request)
    {
        $siswa = new siswa;
        $siswa->NIS = $request->input('NIS');
        $siswa->nama = $request->input('nama');
        $siswa->kelas = $request->input('kelas');
        $siswa->save();

        return redirect()->back()->with('success', 'Siswa berhasil disimpan');
    }

    public function show()
    {
        $data = siswa::all();
        $NIS = [];
        $nama = [];
        foreach ($data as $siswa) {
            $NIS[] = $siswa->NIS;
            $nama[] = $siswa->nama;
        }

        $kelas = \App\Models\kelas::orderBy('nomor_kelas')->orderBy('huruf_kelas')->get();

        return view('pages/admin/data-siswa', compact('NIS', 'nama', 'kelas', 'data'));
    }

    public function delete($id)
    {
        siswa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus');
    }

    public function edit($id)
    {
        $siswa = siswa::findOrFail($id);
        $kelas = \App\Models\kelas::orderBy('nomor_kelas')->orderBy('huruf_kelas')->get();
        return view('pages/admin/data-siswa', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = siswa::findOrFail($id);
        $siswa->NIS = $request->input('NIS');
        $siswa->nama = $request->input('nama');
        $siswa->kelas = $request->input('kelas');
        $siswa->save();

        return redirect()->back()->with('success', 'Siswa berhasil diperbarui');
    }
}

