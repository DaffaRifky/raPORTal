<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = null;
        if (session('user_id')) {
            $user = User::find(session('user_id'));
        }
        return view('home', compact('user'));
    }
}
