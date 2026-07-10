@extends('pages.layout.layout')

@section('title', 'Profil Saya')
@section('header', 'Profil Saya')

@section('content')
@if(session('success'))
    <div class="mb-4 rounded-xl bg-emerald-100 border border-emerald-200 p-4 text-emerald-900">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="mb-4 rounded-xl bg-red-100 border border-red-200 p-4 text-red-900">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('profil-saya.update') }}">
    @csrf
    @method('PUT')

    <div class="flex mb-6 flex-col md:flex-row">
        <div class="bg-slate-700 p-4 rounded-tl-xl rounded-tr-xl md:rounded-tr-none md:rounded-bl-xl items-center justify-center grid grid-rows-2 md:flex md:flex-col">
            {{-- Foto Profil --}}
            <h1 class="text-white mb-2 text-center text-xl font-medium mt-2">Foto Profil</h1>
            @if (empty(Auth::user()->image))
                {{-- show placeholder --}}
                <a onclick="document.getElementById('updateProfileModal').classList.remove('hidden')" class="bg-white cursor-pointer hover:bg-gray-100 w-60 h-80 border border-black/30 rounded-xl shadow-md m-6 mt-3 text-lg text-gray-500 text-center flex items-center justify-center">No Image <br> (3 X 4)</a>
            @else
            <a onclick="document.getElementById('updateProfileModal').classList.remove('hidden')" class="w-60 h-80 cursor-pointer hover:bg-amber-50 rounded-xl shadow-md m-6 mt-3 text-xl font-medium text-gray-500 text-center flex items-center justify-center">
                <img class="image rounded-xl w-60 h-80 shadow-md border-2 border-black/30 absolute hover:opacity-30"
                    src="{{ asset('storage/images/' . auth()->user()->image) }}"
                    alt="profile_image">Pilih Foto Profil Baru <br> (3 X 4)</a>
            @endif

            {{-- Tanda Tangan --}}
            @if(auth()->user()->role !== 'Admin TU')
                <h1 class="text-white mb-2 text-center text-xl font-medium mt-5">Tanda Tangan</h1>
                @if (empty(Auth::user()->tanda_tangan))
                    {{-- show placeholder --}}
                    <a onclick="document.getElementById('updateTandaTanganModal').classList.remove('hidden')" class="bg-white cursor-pointer hover:bg-gray-100 w-60 h-60 border border-black/30 rounded-xl shadow-md m-6 mt-3 text-lg text-gray-500 text-center flex items-center justify-center">No Image <br> (QR atau Scan)</a>
                @else
                <a onclick="document.getElementById('updateTandaTanganModal').classList.remove('hidden')" class="w-60 h-60 cursor-pointer hover:bg-amber-50 rounded-xl shadow-md m-6 mt-3 text-xl font-medium text-gray-500 text-center flex items-center justify-center">
                    <img class="image rounded-xl md:w-60 md:h-60 w-30 h-30 shadow-md border-2 border-black/30 absolute hover:opacity-30"
                        src="{{ asset('storage/images/' . auth()->user()->tanda_tangan) }}"
                        alt="signature_image">Pilih Tanda Tangan Baru <br>(QR atau Scan)</a>
                @endif
            @endif
        </div>

        <div class="w-full p-8 pt-6 bg-linear-to-r from-slate-300 to-[#e2e2e2] rounded-br-xl rounded-bl-xl md:rounded-tr-xl md:rounded-bl-none shadow-md">
            <h1 class="text-xl font-bold mb-4">Data Pribadi</h1>
            <div class="grid grid-cols-2 gap-4 mb-13">
                <div class="col-span-2 lg:col-span-1">
                    <label for="nip" class="block text-sm font-medium mb-1">NIP</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 text-gray-400" type="text" id="nip" name="nip" value="{{ old('nip', $user->nip) }}" disabled>
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="nama" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300  rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}">
                </div>

                <div class="col-span-2 lg:col-span-1">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="no_hp" class="block text-sm font-medium mb-1">No.HP</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="perguruan" class="block text-sm font-medium mb-1">Perguruan Tinggi</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 text-gray-400" type="text" id="perguruan" name="perguruan" value="{{ old('perguruan', $user->perguruan) }}" disabled>
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="pendidikan" class="block text-sm font-medium mb-1">Pendidikan terakhir</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 text-gray-400" type="text" id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $user->pendidikan) }}" disabled>
                </div>
                <div class="col-span-2">
                    <label for="alamat" class="block text-sm font-medium mb-1">Alamat</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}">
                </div>
            </div>
            <h1 class="text-xl font-bold mb-4">Ubah Password</h1>
            <div class="lg:grid lg:grid-cols-3 gap-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium mb-1">Password Lama</label>
                    <input id="current_password" name="current_password" class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="password" autocomplete="current-password">
                </div>
                <div>
                    <label for="new_password" class="block text-sm font-medium mb-1">Password Baru</label>
                    <input id="new_password" name="new_password" class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="password" autocomplete="new-password">
                </div>
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium mb-1">Ulangi Password Baru</label>
                    <input id="new_password_confirmation" name="new_password_confirmation" class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="password" autocomplete="new-password">
                </div>
            </div>
            <div class="mb-4 flex justify-end">
                <button type="submit" class="w-full text-center bg-cyan-500 hover:bg-cyan-600 cursor-pointer text-white p-2 rounded-2xl">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</form>

{{-- modal update foto profil --}}
<div id="updateProfileModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
        <button onclick="document.getElementById('updateProfileModal').classList.add('hidden')"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <h2 class="mb-4 text-xl font-semibold text-gray-800">Masukkan foto profil baru</h2>
        <hr class="mb-4 opacity-30 border">
        <form action="{{route('profil-saya.upload-foto-profil')}}" method="POST" class="grid grid-cols-3 gap-4" enctype="multipart/form-data">
                @csrf
                <input type="file" class="col-span-2 px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200" name="image">
                <input type="submit" class="text-center bg-[#0A95FF] text-white p-2 rounded-xl" value="Upload">
        </form>
    </div>
</div>

{{-- modal update tanda tangan --}}
<div id="updateTandaTanganModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
        <button onclick="document.getElementById('updateTandaTanganModal').classList.add('hidden')"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <h2 class="mb-4 text-xl font-semibold text-gray-800">Masukkan tanda tangan baru</h2>
        <hr class="mb-4 opacity-30 border">
        <form action="{{route('profil-saya.upload-tanda-tangan')}}" method="POST" class="grid grid-cols-3 gap-4" enctype="multipart/form-data">
                @csrf
                <input type="file" class="col-span-2 px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200" name="image">
                <input type="submit" class="text-center bg-[#0A95FF] text-white p-2 rounded-xl" value="Upload">
        </form>
    </div>
</div>
@endsection
