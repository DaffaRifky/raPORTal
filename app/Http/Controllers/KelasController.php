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
        $kelas = Kelas::orderBy('nomor_kelas')->orderBy('huruf_kelas')->get();

        return view('pages.adminTU.data-kelas', compact('kelas'));
        return view('pages.adminTU.data-siswa', compact('kelas'));
    }
}
