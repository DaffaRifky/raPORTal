<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guru;
use App\Models\User;

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
        $data = guru::where('role', 'guru')->get();
        $NIP = [];
        $nama = [];
        foreach ($data as $guru) {
            $NIP[] = $guru->nip;
            $nama[] = $guru->nama;
        }

        return view('pages/admin/data-guru', compact('NIP', 'nama'));
    }

    public function adminData()
    {
        $data = guru::where('role', 'Admin')->get();
        $NIP = [];
        $nama = [];
        foreach ($data as $user) {
            $NIP[] = $user->email;
            $nama[] = $user->name;
        }

        return view('pages/admin/data-admin', compact('NIP', 'nama'));
    }
}
