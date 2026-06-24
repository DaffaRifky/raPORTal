@extends('pages.layout.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard ' . auth()->user()->role)

@section('content')

@if(auth()->user()->role === 'Guru')
<div class="container">
    <div class="mb-6 p-6 bg-[#E2E2E2] rounded-lg shadow-md">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="bg-white rounded-lg px-6 py-4 shadow-sm">
                <p class="text-sm text-gray-500">Kelas Diampu</p>
                <p class="text-3xl font-semibold mt-1">{{ $jumlahKelas }}</p>
            </div>
            <div class="bg-white rounded-lg px-6 py-4 shadow-sm">
                <p class="text-sm text-gray-500">Jumlah Siswa</p>
                <p class="text-3xl font-semibold mt-1">{{ $jumlahSiswa }}</p>
            </div>
            <div class="bg-white rounded-lg px-6 py-4 shadow-sm">
                <p class="text-sm text-gray-500">Mata Pelajaran Diampu</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    @forelse ($mataPelajaran as $mp)
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                            {{ $mp->nama }}
                        </span>
                    @empty
                        <span class="text-gray-400 text-sm">Belum ada</span>
                    @endforelse
                </div>
            </div>
        </div>
        {{-- Kepala Sekolah --}}
        <div class="bg-white rounded-lg px-6 py-2 shadow-sm">
            <p class="text-sm text-gray-500">Kepala Sekolah</p>
            <p class="text-2xl font-semibold">
                {{ $kepalaSekolah?->nama ?? 'Belum ditentukan' }}
            </p>
        </div>
    </div>
</div>
@endif

@if(auth()->user()->role === 'Admin TU')
    {{-- Stat Cards --}}
<div class="container">
    <div class="mb-6 p-6 bg-[#E2E2E2] rounded-lg shadow-md">
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="bg-white border border-gray-200 rounded-2xl px-6 py-4">
                <p class="text-sm text-gray-500 mb-1">Jumlah Guru</p>
                <p class="text-3xl font-bold text-gray-800">{{ $jumlahGuru }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl px-6 py-4">
                <p class="text-sm text-gray-500 mb-1">Jumlah Kelas</p>
                <p class="text-3xl font-bold text-gray-800">{{ $jumlahKelas }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl px-6 py-4">
                <p class="text-sm text-gray-500 mb-1">Jumlah Siswa</p>
                <p class="text-3xl font-bold text-gray-800">{{ $jumlahSiswa }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl px-6 py-4">
                <p class="text-sm text-gray-500 mb-1">Jumlah Admin TU</p>
                <p class="text-3xl font-bold text-gray-800">{{ $jumlahAdminTU }}</p>
            </div>
        </div>
        {{-- Kepala Sekolah Card --}}
        <div class="bg-white border border-gray-200 rounded-2xl px-6 py-2">
            <p class="text-sm text-gray-500 ">Kepala Sekolah</p>
            <p class="text-2xl font-semibold text-gray-800">
                {{ $kepalaSekolah?->nama ?? 'Belum ada data Kepala Sekolah' }}
            </p>
        </div>
    </div>
</div>
@endif

@if(auth()->user()->role === 'Kepala Sekolah')
    <div class="mb-6 p-6 bg-[#E2E2E2] rounded-lg shadow-md">
        <div class="grid grid-cols-4 gap-6">
            <div class="bg-white shadow-md rounded-xl p-4">
                <p class="text-sm">Jumlah Guru</p>
                <p class="text-2xl">{{ $jumlahGuru }}</p>   {{-- was hardcoded 35 --}}
            </div>
            <div class="bg-white shadow-md rounded-xl p-4">
                <p class="text-sm">Jumlah Kelas</p>
                <p class="text-2xl">{{ $jumlahKelas }}</p>  {{-- was hardcoded 14 --}}
            </div>
            <div class="bg-white shadow-md rounded-xl p-4">
                <p class="text-sm">Jumlah Siswa</p>
                <p class="text-2xl">{{ $jumlahSiswa }}</p>  {{-- was hardcoded 453 --}}
            </div>
            <div class="bg-white shadow-md rounded-xl p-4">
                <p class="text-sm">Jumlah Admin</p>
                <p class="text-2xl">{{ $jumlahAdminTU }}</p> {{-- was hardcoded 15 --}}
            </div>
        </div>
    </div>
@endif



{{-- kartu data pribadi --}}
    <div class="p-8  bg-[#E2E2E2] rounded-lg shadow-md flex gap-6 ">
        <div class="flex-none">
            @if (empty(Auth::user()->image))
                {{-- show placeholder --}}
                <div class="bg-white w-60 h-80 rounded-xl border-2 border-black/30 shadow-md">
                </div>
            @else
                <img class="image rounded-xl w-60 h-80 shadow-md border-2 border-black/30"
                    src="{{ asset('storage/images/' . auth()->user()->image) }}"
                    alt="profile_image">
            @endif
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
