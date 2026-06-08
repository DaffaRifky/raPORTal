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
        // If already authenticated, redirect to the appropriate dashboard
        if (Auth::check()) {
            $user = Auth::user();
            switch ($user->role ?? '') {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'guru':
                    return redirect()->route('guru.dashboard');
                case 'wakel':
                case 'kepsek':
                default:
                    return redirect()->route('guru.dashboard');
            }
        }

        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'password' => ['required'],
            'role'     => ['required', 'in:admin,guru,wakel,kepsek'],
        ]);

        $identifier = $request->input('nama');
        $password = $request->input('password');

        $guru = guru::where('nip', $identifier)
            ->orWhere('nama', $identifier)
            ->first();

        if ($guru && Hash::check($password, $guru->password)) {

            // Check that the user's actual role matches the selected role
            if (!isset($guru->role) || $guru->role !== $request->input('role')) {
                return back()->withErrors([
                    'role' => 'Selected role does not match the account role.',
                ])->withInput($request->except('password'));
            }

            Auth::login($guru, $request->boolean('remember'));
            $request->session()->regenerate();

            // Redirect based on role
            $role = $guru->role ?? '';
            $fallback = route('guru.dashboard');
            if ($role === 'admin') {
                $fallback = route('admin.dashboard');
            }

            return redirect()->intended($fallback);
        }

        return back()->withErrors([
            'nama' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('nama', 'role'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
