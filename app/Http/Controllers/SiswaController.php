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

        return view('pages/admin/data-siswa', compact('NIS', 'nama'));
    }
}
