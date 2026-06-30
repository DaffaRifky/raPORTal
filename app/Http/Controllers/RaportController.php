<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;
use App\Models\Tugas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mp;
use App\Models\GuruMengajar;

class PDFController extends Controller
{
    public function show()
    {
        return view('');
    }
}
