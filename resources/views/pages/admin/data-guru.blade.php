<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<body class="bg-[#E8F1FE] ml-64 p-4">
    <x-sidebar-admin />
    <div class="container py-4 px-8 bg-white border border-black/30 rounded-2xl shadow-md">
        <p class="text-2xl mb-4">Data Guru</p>
        <hr class="mb-4 opacity-30 border">
        <div class="grid grid-cols-5 gap-4 mb-6">
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 col-span-4" type="text" placeholder="Masukan Nama atau NIP">
            <a href="" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-center">Tambah Guru +</a>
        </div>
        <div class="border border-black/30 rounded-2xl overflow-hidden mb-4">

            <table>
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama </th>
                        <th>Mata Pelajaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nama as $index => $item)
                        <tr>
                            <td>{{ $NIP[$index] }}</td>
                            <td>{{ $item }}</td>

                        </tr>
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


