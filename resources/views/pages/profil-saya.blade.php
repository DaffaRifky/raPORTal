@extends('pages.layout.layout')

@section('title', 'Profil Saya')
@section('header', 'Profil Saya')

@section('content')
<form {{-- action="{{ route('profil-saya.update') }}" --}} >
    <div class="flex mb-6">
        <div class="flex-none bg-[#617a9e] p-4 rounded-tl-xl rounded-bl-xl shadow-md ">
            <p class="text-white mb-2 text-center text-xl font-medium mt-2">Foto Profil</p>
            @if (empty(Auth::user()->image))
                {{-- show placeholder --}}
                <a onclick="document.getElementById('updateProfileModal').classList.remove('hidden')" class="bg-white cursor-pointer hover:bg-gray-100 w-60 h-80 border border-black/30 rounded-xl shadow-md m-6 text-lg text-gray-500 text-center flex items-center justify-center">No Image</a>
            @else
            <a onclick="document.getElementById('updateProfileModal').classList.remove('hidden')" class="w-60 h-80 cursor-pointer hover:bg-amber-50 rounded-xl shadow-md m-6 text-xl font-medium text-gray-500 text-center flex items-center justify-center">
                <img class="image rounded-xl w-60 h-80 shadow-md border-2 border-black/30 absolute hover:opacity-30"
                    src="{{ asset('storage/images/' . auth()->user()->image) }}"
                    alt="profile_image">Pilih Foto Profil Baru</a>
            @endif
        </div>

        <div class="flex-1 p-8 bg-[#e2e2e2] rounded-tr-lg rounded-br-lg shadow-md">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 lg:col-span-1">
                    <label for="nip" class="block text-sm font-medium mb-1">NIP</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="nip" name="nip" value="1234567890">
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="nama" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300  rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="nama" name="nama" value="John Doe" >
                </div>

                <div class="col-span-2 lg:col-span-1">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="email" id="email" name="email" value="">
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="nama" class="block text-sm font-medium mb-1">No.HP</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="HP" name="HP" value="081234567890">
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="email" class="block text-sm font-medium mb-1">Perguruan Tinggi</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="perguruan" name="perguruan" value="">
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <label for="email" class="block text-sm font-medium mb-1">Pendidikan terakhir</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="pendidikan" name="pendidikan" value="">
                </div>
                <div class="col-span-2">
                    <label for="email" class="block text-sm font-medium mb-1">Alamat</label>
                    <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="alamat" name="alamat" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 flex justify-end">
        <a class="w-full text-center bg-[#0A95FF] text-white p-2 rounded-2xl" href="/dashboard">Simpan Perubahan</a>
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

        <h2 class="mb-4 text-xl font-semibold text-gray-800 mb-1">Masukkan foto profil baru</h2>
        <hr class="mb-4 opacity-30 border">
        <form action="{{route('profil-saya.upload')}}" method="POST" class="grid grid-cols-3 gap-4" enctype="multipart/form-data">
                @csrf
                <input type="file" class="col-span-2 px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200" name="image">
                <input type="submit" class="text-center bg-[#0A95FF] text-white p-2 rounded-xl" value="Upload">
        </form>
    </div>
</div>
@endsection
