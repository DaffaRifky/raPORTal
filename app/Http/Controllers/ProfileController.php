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
        return view('pages/profil-saya');
    }

    public function update(Request $request, $id)
    {
        $users             = User::findOrFail($id);
        $users->nip        = $request->input('nip');
        $users->nama       = $request->input('nama');
        $users->no_hp      = $request->input('no_hp');
        $users->email      = $request->input('email');
        $users->perguruan  = $request->input('perguruan');
        $users->pendidikan = $request->input('pendidikan');
        $users->alamat     = $request->input('alamat');

        if ($request->filled('password')) {
            $users->password = Hash::make($request->input('password'));
        }

        $users->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $file = $request->image;
            $filename = $file->hashName();
            $request->image->storeAs('images',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
