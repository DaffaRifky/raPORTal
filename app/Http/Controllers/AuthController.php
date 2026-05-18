<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        session(['user_id' => $user->id]);

        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        session(['user_id' => $user->id]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->forget('user_id');
        return redirect()->route('home');
    }
}
