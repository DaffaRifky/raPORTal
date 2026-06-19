@extends('pages.layout.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard ' . auth()->user()->role)

@section('content')

@if(auth()->user()->role === 'Guru')
    <div class="container">
        <div class="mb-6 p-6 bg-[#E2E2E2] rounded-lg shadow-md">
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div class="container bg-white shadow-md rounded-xl p-4">
                    <p class="text-sm">Kelas Diampu</p>
                    <p class="text-2xl">4</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4 ">
                    <p class="text-sm">Jumlah Siswa</p>
                    <p class="text-2xl">120</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4 ">
                    <p class="text-sm mb-1">Mata Pelajaran Diampu</p>
                    <ul class="flex flex-row gap-2">
                        <li class="text-lg rounded-full bg-gray-300 px-2">Matematika</li>
                        <li class="text-lg rounded-full bg-gray-300 px-2">Fisika</li>
                    </ul>
                </div>
            </div>
            <div class="container bg-white shadow-md rounded-xl px-6 py-2 w-full m-auto">
                    <p class="text-xs">Kepala Sekolah</p>
                    <p class="text-xl">John Doe</p>
            </div>
        </div>
    </div>
@endif

@if(auth()->user()->role === 'Admin TU')
    <div class="container">
        <div class="mb-6 p-6 bg-[#E2E2E2] rounded-lg shadow-md">
            <div class="grid grid-cols-4 gap-6 mb-6">
                <div class="container bg-white shadow-md rounded-xl p-4 ">
                    <p class="text-sm">Jumlah Guru</p>
                    <p class="text-2xl">35</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4">
                    <p class="text-sm">Jumlah Kelas</p>
                    <p class="text-2xl">14</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4">
                    <p class="text-sm">Jumlah Siswa</p>
                    <p class="text-2xl">453</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4 ">
                    <p class="text-sm">Jumlah Admin TU</p>
                    <p class="text-2xl">15</p>
                </div>
            </div>
            <div class="container bg-white shadow-md rounded-xl px-6 py-2 w-[100%] m-auto">
                    <p class="text-xs">Kepala Sekolah</p>
                    <p class="text-xl">John Doe</p>
            </div>
        </div>
    </div>
@endif

@if(auth()->user()->role === 'Kepala Sekolah')
    <div class="container">
        <div class="mb-6 p-6 bg-[#E2E2E2] rounded-lg shadow-md">
            <div class="grid grid-cols-4 gap-6 mb-6">
                <div class="container bg-white shadow-md rounded-xl p-4">
                    <p class="text-sm">Jumlah Guru</p>
                    <p class="text-2xl">35</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4 ">
                    <p class="text-sm">Jumlah Kelas</p>
                    <p class="text-2xl">14</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4 ">
                    <p class="text-sm">Jumlah Siswa</p>
                    <p class="text-2xl">453</p>
                </div>
                <div class="container bg-white shadow-md rounded-xl p-4 ">
                    <p class="text-sm">Jumlah Admin</p>
                    <p class="text-2xl">15</p>
                </div>
            </div>
        </div>
    </div>
@endif



{{-- kartu data pribadi --}}
    <div class="p-8  bg-[#E2E2E2] rounded-lg shadow-md flex gap-6 ">
        <div class="flex-none">
            <div class="bg-white w-40 h-60 rounded-xl border border-black/30 shadow-md">
            </div>
        </div>
        <div class="flex-1">
            <div class="mb-4 rounded-lg">
                <p class="text-center mb-4 text-xl ">Data Diri {{ auth()->user()->role }}</p>
                <hr class="opacity-30 border">
            </div>
            <table class="[&_td]:!border-0 [&_td]:!py-0 [&_td]:!px-1">
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{ auth()->user()->nip }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ auth()->user()->nama }}</td>
                </tr>
                <tr>
                    <td>No.HP</td>
                    <td>:</td>
                    <td>{{ auth()->user()->no_hp }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ auth()->user()->email }}</td>
                </tr>
                <tr>
                    <td>Perguruan Tinggi</td>
                    <td>:</td>
                    <td>{{ auth()->user()->perguruan }}</td>
                </tr>
                <tr>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <td>{{ auth()->user()->pendidikan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ auth()->user()->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
