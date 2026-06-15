@extends('pages.layout.layout')

@section('title', 'Data Kelas')
@section('header', 'Data Kelas')

@section('content')
        <div class="grid grid-cols-5 gap-4 mb-6">
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 col-span-4" type="text" placeholder="Masukan Nama Kelas">
            <button
                onclick="document.getElementById('addKelasModal').classList.remove('hidden')"
                class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-5 py-2 rounded-lg transition whitespace-nowrap">
                Tambah Kelas
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </button>
        </div>
        <div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
            <table class="w-full">
                <thead class="bg-gray-100 text-gray-600 font-medium">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">Nama </th>
                        <th class="px-6 py-4 text-left font-semibold">Jumlah Siswa</th>
                        <th class="px-6 py-4 text-left font-semibold">Wali Kelas</th>
                        <th class="px-6 py-4 text-center font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $k)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="uppercase">{{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- modal tambah kelas --}}
            <div id="addKelasModal"
            class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
                <button onclick="document.getElementById('addKelasModal').classList.add('hidden')"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <h2 class="text-xl font-semibold text-gray-800 mb-1">Tambah Kelas Baru</h2>

                <form method="POST" action="{{ route('kelas.simpan') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-5 gap-4">

                        <div class="col-span-4">
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">Nomor Kelas</label>
                            <select name="nomor_kelas"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option disabled selected>— pilih —</option>
                                <option value="10"   {{ old('nomor') === '10'   ? 'selected' : '' }}>10</option>
                                <option value="11" {{ old('nomor') === '11' ? 'selected' : '' }}>11</option>
                                <option value="12"  {{ old('nomor') === '12'  ? 'selected' : '' }}>12</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">Huruf Kelas</label>
                            <input type="text" name="huruf_kelas" value="{{ old('huruf') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button"
                                onclick="document.getElementById('addKelasModal').classList.add('hidden')"
                                class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2.5 text-sm font-medium transition">
                            Tambah Kelas
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>

@endsection
