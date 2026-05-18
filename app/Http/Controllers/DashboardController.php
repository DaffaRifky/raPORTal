<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (! session('user_id')) {
            return redirect()->route('login.show');
        }
        $user = User::find(session('user_id'));
        return view('dashboard', compact('user'));
    }
}
