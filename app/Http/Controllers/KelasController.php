<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function simpan(Request $request)
    {
        $kelas = new Kelas;
        $kelas->nomor_kelas = $request->input('nomor_kelas');
        $kelas->huruf_kelas = $request->input('huruf_kelas');
        $kelas->save();

        return redirect()->back()->with('success', 'Kelas berhasil disimpan');
    }

    public function show()
    {
        $data = Kelas::all();
        $nomor = [];
        $huruf = [];
        foreach ($data as $kelas) {
            $nomor[] = $kelas->nomor_kelas;
            $huruf[] = $kelas->huruf_kelas;
        }

        return view('pages/admin/data-kelas', compact('nomor', 'huruf'));
    }
}
