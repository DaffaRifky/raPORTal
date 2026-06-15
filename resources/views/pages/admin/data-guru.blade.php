@extends('pages.layout.layout')

@section('title', 'Data Guru')
@section('header', 'Data Guru')

@section('content')
        <div class="grid grid-cols-5 gap-4 mb-6">
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 col-span-4" type="text" placeholder="Masukan Nama atau NIP">
            <a href="" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-center">Tambah Guru +</a>
        </div>
        <div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
            <table class="w-full">
                <thead class="bg-gray-100 text-gray-600 font-medium">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">NIP</th>
                        <th class="px-6 py-4 text-left font-semibold">Nama</th>
                        <th class="px-6 py-4 text-left font-semibold">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-center font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nama as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $NIP[$index] }}</td>
                            <td class="px-6 py-4">{{ $item }}</td>
                            <td class="px-6 py-4"></td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button class="text-red-500 hover:text-red-700 ml-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </td>
                    @endforeach
                </tbody>
            </table>

            {{-- modal tambah siswa --}}
            <div id="addGuruModal"
            class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
                <button onclick="document.getElementById('addGuruModal').classList.add('hidden')"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <h2 class="text-xl font-semibold text-gray-800 mb-1">Tambah Guru Baru</h2>

                <form method="POST" action="{{ route('guru.simpan') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-5 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">NIS</label>
                            <input type="text" name="NIS" value="{{ old('NIS') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button"
                                onclick="document.getElementById('addSiswaModal').classList.add('hidden')"
                                class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2.5 text-sm font-medium transition">
                            Tambah siswa
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>


@endsection
