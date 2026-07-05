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

        $user->update([
            'nama' => $request->input('nama'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $file = $request->image;
            $filename = $file->hashName();
            $request->image->storeAs('images',$filename,'public');
            Auth::user()->update(['image'=>$filename]);
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
