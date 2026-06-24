<?php

namespace App\Http\Controllers;

use App\Models\GuruMengajar;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $kepalaSekolah = User::where('role', 'Kepala Sekolah')->first();
        $mataPelajaran = collect();
        $jumlahKelas   = 0;
        $jumlahSiswa   = 0;
        $jumlahGuru    = 0;
        $jumlahAdminTU = 0;

        if ($user->role === 'Guru') {
            $mengajar = GuruMengajar::with(['kelas.siswas', 'mp'])
                            ->where('user_id', $user->id)
                            ->get();

            $jumlahKelas   = $mengajar->pluck('kelas_id')->unique()->count();
            $jumlahSiswa   = $mengajar->pluck('kelas')->unique('id')
                                      ->sum(fn($kelas) => $kelas->siswas->count());
            $mataPelajaran = $mengajar->pluck('mp')->unique('id');

        } elseif ($user->role === 'Admin TU' || $user->role === 'Kepala Sekolah') {
            $jumlahGuru    = User::where('role', 'Guru')->count();
            $jumlahKelas   = Kelas::count();
            $jumlahSiswa   = Siswa::count();
            $jumlahAdminTU = User::where('role', 'Admin TU')->count();
        }

        return view('pages.dashboard', compact(
            'kepalaSekolah',
            'mataPelajaran',
            'jumlahKelas',
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahAdminTU'
        ));
    }
}
