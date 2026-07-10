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
        Tugas::create([
            'nama' => $request->input('nama'),
            'tipe' => $request->input('tipe'),
            'mp_id' => $request->input('mp_id'),
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        Tugas::where('id', $id)->update([
            'nama' => $request->input('nama'),
            'tipe' => $request->input('tipe'),
            'mp_id' => $request->input('mp_id'),
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui');
    }

    public function delete($id)
    {
        $tugas = Tugas::findOrFail($id);

        if (in_array($tugas->tipe, ['UTS', 'UAS'])) {
            return redirect()->back()->with('error', 'UTS dan UAS wajib ada dan tidak bisa dihapus.');
        }

        $tugas->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }
}
