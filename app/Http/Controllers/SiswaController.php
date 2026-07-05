<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;

class SiswaController extends Controller
{
    public function simpan(Request $request)
    {
        Siswa::create([
            'NIS'      => $request->input('NIS'),
            'nama'     => $request->input('nama'),
            'kelas_id' => $request->input('kelas'),
        ]);

        return redirect()->back()->with('success', 'Siswa berhasil disimpan');
    }

    public function show()
    {
        $data = Siswa::all();
        $NIS = [];
        $nama = [];
        $kelas_id = [];
        foreach ($data as $siswa) {
            $NIS[] = $siswa->NIS;
            $nama[] = $siswa->nama;
            $kelas_id[] = $siswa->kelas_id;
        }

        $kelas = \App\Models\Kelas::orderBy('nomor_kelas')->orderBy('huruf_kelas')->get();

        return view('pages/adminTU/data-siswa', compact('NIS', 'nama', 'kelas', 'data'));
    }

    public function update(Request $request, $id)
    {
        Siswa::where('id', $id)->update([
            'NIS'      => $request->input('NIS'),
            'nama'     => $request->input('nama'),
            'kelas_id' => $request->input('kelas'),
        ]);

        return redirect()->back()->with('success', 'Siswa berhasil diperbarui');
    }

        public function delete($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus');
    }

    public function checkNis(Request $request)
    {
        $nis = $request->input('nis');
        $excludeId = $request->input('exclude_id');
        
        $query = Siswa::where('NIS', $nis);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        $exists = $query->exists();
        
        return response()->json(['exists' => $exists]);
    }
}

