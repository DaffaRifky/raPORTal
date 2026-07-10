<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\user;

class Login extends Controller
{
    public function showLoginForm()
    {
        // If already authenticated, redirect to the appropriate dashboard
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role ?? '';
            return redirect()->route('dashboard');
        }

        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'password' => ['required'],
        ]);

        $identifier = $request->input('nama');
        $password = $request->input('password');

        $user = user::where('nip', $identifier)
            ->orWhere('nama', $identifier)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
        }

        return back()->withErrors([
            'nama' => 'nip atau nama atau password yang dimasukkan salah.',
        ])->withInput($request->only('nama'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
