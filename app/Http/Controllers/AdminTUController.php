<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminTUController extends Controller
{
    public function simpan(Request $request)
    {
        User::create([
            'nip'  => $request->input('NIP'),
            'nama' => $request->input('nama'),
            'role' => 'Admin TU',
            'no_hp' => $request->input('no_hp') ?? null,
            'email' => $request->input('email') ?? null,
            'perguruan' => $request->input('perguruan') ?? null,
            'pendidikan' => $request->input('pendidikan') ?? null,
            'alamat' => $request->input('alamat') ?? null,
            'image' => $request->input('image') ?? null,
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->back()->with('success', 'Admin berhasil disimpan');
    }

    public function show()
    {
        $adminTUs = User::where('role', 'Admin TU')->get();
        $NIP = [];
        $nama = [];
        foreach ($adminTUs as $adminTU) {
            $NIP[] = $adminTU->nip;
            $nama[] = $adminTU->nama;
        }

        return view('pages/adminTU/data-admin-TU', compact('adminTUs'));
    }

        public function delete($id)
    {
        User::findOrFail($id)->delete();
        return \redirect()->back()->with('success', 'Admin TU berhasil dihapus');
    }

    public function update(Request $request, $id)
    {

        User::where('id', $id)->update([
            'nip' => $request->input('NIP'),
            'nama' => $request->input('nama'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'perguruan' => $request->input('perguruan'),
            'pendidikan' => $request->input('pendidikan'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect()->back()->with('success', 'Admin TU berhasil diperbarui');
    }
}
