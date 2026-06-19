<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AdminTUController extends Controller
{
        public function simpan(Request $request)
    {
        user::create([
            'nip'  => $request->input('NIP'),
            'nama' => $request->input('nama'),
            'role' => 'Admin TU',
            'no_hp' => $request->input('no_hp') ?? null,
            'email' => $request->input('email') ?? null,
            'perguruan' => $request->input('perguruan') ?? null,
            'pendidikan' => $request->input('pendidikan') ?? null,
            'alamat' => $request->input('alamat') ?? null,
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->back()->with('success', 'Admin berhasil disimpan');
    }

        public function show()
    {
        $adminTUs = user::where('role', 'Admin TU')->get();
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
        user::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Admin TU berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $adminTU = user::findOrFail($id);
        $adminTU->NIP = $request->input('NIP');
        $adminTU->nama = $request->input('nama');
        if ($request->filled('password')) {
            $adminTU->password = Hash::make($request->input('password'));
        }
        $adminTU->save();

        return redirect()->back()->with('success', 'Admin TU berhasil diperbarui');
    }
}
