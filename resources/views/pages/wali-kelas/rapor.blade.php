@extends('pages.layout.layout')

@section('title', 'Mata Pelajaran')
@section('header', 'Mata Pelajaran')

@section('content')

{{-- ===== SEARCH + FILTERS ===== --}}
<div class="flex gap-4 mb-4">
    {{-- Pilih Siswa --}}
    <div class="w-48">
        <select onchange="applyFilter('siswa_id', this.value)"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-400">
            @forelse ($allKelas as $k)
                <option value="{{ $k->id }}" {{ $k->id == $selectedKelasId ? 'selected' : '' }}>
                    {{ $siswa->nama }}
                </option>
            @empty
                <option value="">-- Belum ada Siswa --</option>
            @endforelse
        </select>
    </div>

    {{-- Pilih Kelas --}}
    <div class="w-48">
        <select onchange="applyFilter('kelas_id', this.value)"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-400">
            @forelse ($allKelas as $k)
                <option value="{{ $k->id }}" {{ $k->id == $selectedKelasId ? 'selected' : '' }}>
                    {{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}
                </option>
            @empty
                <option value="">-- Belum ada kelas --</option>
            @endforelse
        </select>
    </div>

    {{-- Pilih Mata Pelajaran --}}
    <div class="w-64">
        <select onchange="applyFilter('mp_id', this.value)"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-400">
            @forelse ($allMps as $mp)
                <option value="{{ $mp->id }}" {{ $mp->id == $selectedMpId ? 'selected' : '' }}>
                    {{ $mp->nama }}
                </option>
            @empty
                <option value="">-- Belum ada mata pelajaran --</option>
            @endforelse
        </select>
    </div>
</div>

<div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
    <table class="w-full">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-6 py-4 text-left font-semibold">No.</th>
                <th class="px-6 py-4 text-left font-semibold">Mata Pelajaran</th>
                <th class="px-6 py-4 text-left font-semibold">Nilai Akhir</th>
                <th class="px-6 py-4 text-center font-semibold">Predikat</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="MPTable">
            @forelse ($mps as $mp)
                <tr class="hover:bg-gray-50 transition">
                    <th class="w-5">{{ $loop->iteration }}</th>
                    <td class="px-6 py-4 ">
                        {{ $mp->nama }}
                    </td>
                    <td class="px-6 py-4 text-sm uppercase">
                        {{ $mp->singkatan }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button
                            onclick="openEditModal(this)"
                            data-id="{{ $mp->id }}"
                            data-nama="{{ $mp->nama }}"
                            data-singkatan="{{ $mp->singkatan }}"
                            class="text-blue-500 hover:text-blue-700 hover:bg-blue-100
                                   rounded-lg transition px-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form method="POST" action="{{ route('mp.delete', $mp->id) }}"
                              style="display:inline"
                              onsubmit="return confirm('Yakin hapus kelas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-500 hover:text-red-700 hover:bg-red-100
                                       rounded-lg transition px-1 ml-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">
                        Belum ada kelas. Klik "Tambah Mata Pelajaran" untuk menambahkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
