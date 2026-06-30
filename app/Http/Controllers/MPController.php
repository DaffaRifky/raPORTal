<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mp;

class MPController extends Controller
{
    public function show()
    {
        $mps = Mp::all();
        $nama = [];
        $singkatan = [];
        foreach ($mps as $mp) {
            $nama[] = $mp->nama;
            $singkatand[] = $mp->singkatan;
        }

        return view('pages/adminTU/mata-pelajaran', compact('mps'));
    }

    public function simpan(Request $request)
    {
        $mp = new Mp;
        $mp->nama = $request->input('nama');
        $mp->singkatan = $request->input('singkatan');
        $mp->save();

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil disimpan');
    }

    public function delete($id)
    {
        Mp::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $mp = Mp::findOrFail($id);
        $mp->nama = $request->input('nama');
        $mp->singkatan = $request->input('singkatan');
        $mp->save();

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil diperbarui');
    }
}

