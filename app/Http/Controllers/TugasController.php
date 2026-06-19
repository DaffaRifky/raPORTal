<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\Mp;

class TugasController extends Controller
{
    public function index()
    {
        $tugasList = Tugas::with('mp')->orderBy('mp_id')->orderBy('tipe')->orderBy('nama')->get();
        $mps       = Mp::orderBy('nama')->get();

        return view('pages.adminTU.kelola-tugas', compact('tugasList', 'mps'));
    }

    public function simpan(Request $request)
    {
        $tugas       = new Tugas;
        $tugas->nama = $request->input('nama');
        $tugas->tipe = $request->input('tipe');
        $tugas->mp_id = $request->input('mp_id');
        $tugas->save();

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $tugas       = Tugas::findOrFail($id);
        $tugas->nama = $request->input('nama');
        $tugas->tipe = $request->input('tipe');
        $tugas->mp_id = $request->input('mp_id');
        $tugas->save();

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui');
    }

    public function delete($id)
    {
        Tugas::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }
}
