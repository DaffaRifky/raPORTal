<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guru;

class GuruController extends Controller
{
    public function simpan(Request $request)
    {
        $guru = new guru;
        $guru->nip = $request->input('NIP');
        $guru->nama = $request->input('nama');
        $guru->save();

        return redirect()->back()->with('success', 'Guru berhasil disimpan');
    }

    public function show()
    {
        $data = guru::all();
        $NIP = [];
        $nama = [];
        foreach ($data as $guru) {
            $NIP[] = $guru->nip;
            $nama[] = $guru->nama;
        }

        return view('pages/admin/data-guru', compact('NIP', 'nama'));
    }
}
