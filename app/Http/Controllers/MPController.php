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
            $singkatan[] = $mp->singkatan;
        }

        return view('pages/adminTU/mata-pelajaran', compact('mps'));
    }

    public function simpan(Request $request)
    {

        Mp::create([
            'nama' => $request->input('nama'),
            'singkatan' => $request->input('singkatan'),
        ]);

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil disimpan');
    }

    public function delete($id)
    {
        Mp::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        Mp::where('id', $id)->update([
            'nama' => $request->input('nama'),
            'singkatan' => $request->input('singkatan'),
        ]);

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil diperbarui');
    }
}

