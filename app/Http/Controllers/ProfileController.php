<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('pages/profil-saya', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:20|unique:users,no_hp,' . $user->id,
            'alamat' => 'nullable|string|max:500',
            'current_password' => ['nullable', 'required_with:new_password', function ($attribute, $value, $fail) use ($user) {
                if ($value && !Hash::check($value, $user->password)) {
                    $fail('Password lama tidak cocok.');
                }
            }],
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
        ];

        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->input('new_password'));
        }

        $user->update($data);

        $message = $request->filled('new_password') ? 'Profil dan password berhasil diperbarui' : 'Profil berhasil diperbarui';

        return redirect()->back()->with('success', $message);
    }

    public function uploadFP(Request $request)
    {
        if($request->hasFile('image')){
            $file = $request->image;
            $filename = $file->hashName();
            $request->image->storeAs('images',$filename,'public');
            Auth::user()->update(['image'=>$filename]);
        }
        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
    public function uploadTT(Request $request)
    {
        if($request->hasFile('tanda_tangan')){
            $file = $request->tanda_tangan;
            $filename = $file->hashName();
            $request->tanda_tangan->storeAs('images',$filename,'public');
            Auth::user()->update(['tanda_tangan'=>$filename]);
        }
        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function checkDuplicate(Request $request)
    {
        $nip = $request->input('nip');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $excludeId = $request->input('exclude_id');
        
        $query = User::where(function ($q) use ($nip, $email, $no_hp) {
            if ($nip) {
                $q->orWhere('nip', $nip);
            }
            if ($email) {
                $q->orWhere('email', $email);
            }
            if ($no_hp) {
                $q->orWhere('no_hp', $no_hp);
            }
        });
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        $exists = $query->exists();
        
        return response()->json(['exists' => $exists]);
    }
}
