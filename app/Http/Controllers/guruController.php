<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mp;
use App\Models\Kelas;
use App\Models\GuruMengajar;

class GuruController extends Controller
{
    public function show()
    {
        $gurus = User::where('role', 'Guru')
                     ->with(['mengajar.kelas', 'mengajar.mp'])
                     ->get();
        $mps   = Mp::all();
        $kelas = Kelas::orderBy('huruf_kelas')->get();

        return view('pages/adminTU/data-guru', compact('gurus', 'mps', 'kelas'));
    }

    public function simpan(Request $request)
    {
        $guru = new User;
        $guru->nip        = $request->input('NIP');
        $guru->nama       = $request->input('nama');
        $guru->role       = 'Guru';
        $guru->no_hp      = $request->input('no_hp');
        $guru->email      = $request->input('email');
        $guru->perguruan  = $request->input('perguruan');
        $guru->pendidikan = $request->input('pendidikan');
        $guru->alamat     = $request->input('alamat');
        $guru->password   = Hash::make($request->input('password'));
        $guru->save();

        // Save subject × class teaching assignments
        if ($request->filled('mps') && $request->filled('kelas')) {
            foreach ($request->input('kelas') as $kelasId) {
                foreach ($request->input('mps') as $mpId) {
                    $mengajar           = new GuruMengajar;
                    $mengajar->user_id  = $guru->id;
                    $mengajar->kelas_id = $kelasId;
                    $mengajar->mp_id    = $mpId;
                    $mengajar->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Guru berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $guru             = User::findOrFail($id);
        $guru->nip        = $request->input('nip');   // ← lowercase, matches name="nip" in edit form
        $guru->nama       = $request->input('nama');
        $guru->no_hp      = $request->input('no_hp');
        $guru->email      = $request->input('email');
        $guru->perguruan  = $request->input('perguruan');
        $guru->pendidikan = $request->input('pendidikan');
        $guru->alamat     = $request->input('alamat');

        if ($request->filled('password')) {
            $guru->password = Hash::make($request->input('password'));
        }

        $guru->save();

        GuruMengajar::where('user_id', $guru->id)->delete();

        if ($request->filled('mps') && $request->filled('kelas')) {
            foreach ($request->input('kelas') as $kelasId) {
                foreach ($request->input('mps') as $mpId) {
                    $mengajar           = new GuruMengajar;
                    $mengajar->user_id  = $guru->id;
                    $mengajar->kelas_id = $kelasId;
                    $mengajar->mp_id    = $mpId;
                    $mengajar->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Guru berhasil diperbarui');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Guru berhasil dihapus');
    }
}
