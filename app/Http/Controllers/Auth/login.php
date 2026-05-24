<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\guru;

class Login extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'password' => ['required'],
        ]);

        $identifier = $request->input('nama');
        $password = $request->input('password');

        $guru = guru::where('nip', $identifier)
            ->orWhere('nama', $identifier)
            ->first();

        if ($guru && Hash::check($password, $guru->password)) {
            Auth::login($guru, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('guru.dashboard'));
        }

        return back()->withErrors([
            'nama' => 'The provided credentials do not match our records.',
        ])->onlyInput('nama');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
