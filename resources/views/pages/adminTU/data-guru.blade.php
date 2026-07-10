@extends('pages.layout.layout')

@section('title', 'Data Guru')
@section('header', 'Data Guru')

@section('content')

@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-5 gap-4 mb-6">
    <input type="text" id="searchInput"
placeholder="Masukkan Nama atau NIP"
class="w-full px-3 py-2 border border-gray-300 rounded-xl
        focus:outline-none focus:ring focus:ring-blue-200 col-span-4">
    <a onclick="document.getElementById('addGuruModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl text-center">Tambah Guru +</a>
</div>

<div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
    <table class="w-full">
        <thead class="bg-gray-100 text-gray-600 font-medium">
            <tr>
                <th class="px-6 py-4 text-left font-semibold"><p class="px-2">NIP</p></th>
                <th class="px-6 py-4 text-left font-semibold">Nama</th>
                <th class="px-6 py-4 text-center font-semibold">Mata Pelajaran</th>
                <th class="px-6 py-4 text-center font-semibold">Kelas</th>
                <th class="px-6 py-4 text-right font-semibold"><p class="px-2">Action</p></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="guruTable">
            @foreach ($gurus as $guru)
                @php
                    $assignedMpIds    = $guru->mengajar->pluck('mp_id')->unique()->values();
                    $assignedKelasIds = $guru->mengajar->pluck('kelas_id')->unique()->values();
                    $kelasList        = $guru->mengajar->pluck('kelas')->filter()->unique('id')->values();
                    $mpNames          = $guru->mengajar->pluck('mp.singkatan')->unique()->filter()->values();
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4"><p class="px-2">{{ $guru->nip }}</p></td>
                    <td class="px-6 py-4">{{ $guru->nama }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1 items-center justify-center">
                            @forelse ($mpNames as $nama)
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs">
                                    {{ $nama }}
                                </span>
                            @empty
                                <span class="text-gray-400 text-xs">-</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-6 py-4 uppercase">
                        <div class="flex flex-wrap gap-1 items-center justify-center">
                            @forelse ($kelasList as $k)
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">
                                    {{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}
                                </span>
                            @empty
                                <span class="text-gray-400 text-xs">-</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button
                        class="text-blue-500 hover:text-blue-700 hover:bg-blue-100 rounded-lg transition px-1"
                        onclick="openEditModal(this)"
                        data-id="{{ $guru->id }}"
                        data-nip="{{ $guru->nip }}"
                        data-nama="{{ $guru->nama }}"
                        data-email="{{ $guru->email }}"
                        data-no_hp="{{ $guru->no_hp }}"
                        data-perguruan="{{ $guru->perguruan }}"
                        data-pendidikan="{{ $guru->pendidikan }}"
                        data-alamat="{{ $guru->alamat }}"
                        data-mps="{{ json_encode($assignedMpIds) }}"
                        data-kelas="{{ json_encode($assignedKelasIds) }}"
                        >
                            <svg class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form method="POST" action="{{ route('guru.delete', $guru->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg transition px-1" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- modal tambah guru --}}
<div id="addGuruModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
        <button onclick="document.getElementById('addGuruModal').classList.add('hidden')"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <h2 class="mb-4 text-xl font-semibold text-gray-800 mb-1">Tambah Guru Baru</h2>
        <hr class="mb-4 opacity-30 border">

        <form method="POST" action="{{ route('guru.simpan') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">NIP</label>
                    <input type="text" inputmode="numeric" pattern="[0-9-]*" name="NIP" id="addNIP" value="{{ old('NIP') }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <p id="addNIPError" class="text-red-500 text-xs mt-1 hidden">NIP sudah terdaftar</p>
                </div>

                <div class="col-span-3">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Password</label>
                <div class="flex items-center gap-2">
                    <input type="password" pattern=".{8,}" id="addPwd" name="password" value="{{ old('password') }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <span id="addTogglePwd" class="hover:cursor-pointer" title="Tampilkan/Sembunyikan Password">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"> 
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8L3.07945 4.30466C4.29638 2.84434 6.09909 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8L12.9206 11.6953C11.7036 13.1557 9.90091 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8ZM8 11C9.65685 11 11 9.65685 11 8C11 6.34315 9.65685 5 8 5C6.34315 5 5 6.34315 5 8C5 9.65685 6.34315 11 8 11Z" fill="#000000"></path> 
                            </g>
                        </svg>
                        <svg class="hidden" width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"> 
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 16H13L10.8368 13.3376C9.96488 13.7682 8.99592 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8L3.07945 4.30466C3.14989 4.22013 3.22229 4.13767 3.29656 4.05731L0 0H3L16 16ZM5.35254 6.58774C5.12755 7.00862 5 7.48941 5 8C5 9.65685 6.34315 11 8 11C8.29178 11 8.57383 10.9583 8.84053 10.8807L5.35254 6.58774Z" fill="#000000"></path> <path d="M16 8L14.2278 10.1266L7.63351 2.01048C7.75518 2.00351 7.87739 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8Z" fill="#000000"></path> 
                            </g>
                        </svg>
                    </span>
                </div>
            </div>

            {{-- Mata Pelajaran chips --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Mata Pelajaran</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($mps as $mp)
                        <button type="button"
                            data-id="{{ $mp->id }}"
                            onclick="toggleChip(this, 'mp-inputs', 'mps[]')"
                            class="add-chip-mp chip px-3 py-1 rounded-full border border-blue-500
                                text-blue-500 text-sm transition-colors cursor-pointer">
                            {{ $mp->singkatan }}
                        </button>
                    @endforeach
                </div>
                <div id="mp-inputs"></div>
            </div>

            {{-- Kelas chips --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Kelas</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($kelas as $k)
                        <button type="button"
                            data-id="{{ $k->id }}"
                            onclick="toggleChip(this, 'kelas-inputs', 'kelas[]')"
                            class="add-chip-kelas chip px-3 py-1 rounded-full border border-green-500
                                text-green-500 text-sm transition-colors cursor-pointer uppercase">
                            {{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}
                        </button>
                    @endforeach
                </div>
                <div id="kelas-inputs"></div>
            </div>

            <h1 class="text-lg font-semibold text-gray-800 mb-4">Data Lainnya</h1>

            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Email</label>
                    <input type="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" name="email" id="addEmail" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <p id="addEmailError" class="text-red-500 text-xs mt-1 hidden">Email sudah terdaftar</p>
                </div>

                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">No. HP</label>
                    <input type="text" inputmode="numeric" pattern="[0-9-]*" name="no_hp" id="addNoHP" value="{{ old('no_hp') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <p id="addNoHPError" class="text-red-500 text-xs mt-1 hidden">No. HP sudah terdaftar</p>
                </div>

                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Perguruan Terakhir</label>
                    <input type="text" name="perguruan" value="{{ old('perguruan') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan" value="{{ old('pendidikan') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button"
                        onclick="document.getElementById('addGuruModal').classList.add('hidden')"
                        class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                    Batal
                </button>
                <button type="submit" id="addGuruBtn"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2.5 text-sm font-medium transition">
                    Tambah guru
                </button>
            </div>
        </form>
    </div>
</div>

{{-- modal edit guru --}}
<div id="editGuruModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
        <button onclick="closeEditModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Guru</h2>
        <hr class="mb-4 opacity-30 border">

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-5 gap-4 mb-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">NIP</label>
                    <input type="text" inputmode="numeric" pattern="[0-9-]*" id="edit-nip" name="nip" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <p id="editNIPError" class="text-red-500 text-xs mt-1 hidden">NIP sudah terdaftar</p>
                </div>
                <div class="col-span-3">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                    <input type="text" id="edit-nama" name="nama" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Password Baru
                    <span class="text-gray-400 font-normal text-xs">(kosongkan jika tidak diubah)</span>
                </label>
                <div class="flex gap-2 items-center">
                    <input type="password" pattern=".{8,}" id="editPwd" name="password" "
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <span id="editTogglePwd" class="hover:cursor-pointer" title="Tampilkan/Sembunyikan Password">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"> 
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8L3.07945 4.30466C4.29638 2.84434 6.09909 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8L12.9206 11.6953C11.7036 13.1557 9.90091 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8ZM8 11C9.65685 11 11 9.65685 11 8C11 6.34315 9.65685 5 8 5C6.34315 5 5 6.34315 5 8C5 9.65685 6.34315 11 8 11Z" fill="#000000"></path> 
                            </g>
                        </svg>
                        <svg class="hidden" width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"> 
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 16H13L10.8368 13.3376C9.96488 13.7682 8.99592 14 8 14C6.09909 14 4.29638 13.1557 3.07945 11.6953L0 8L3.07945 4.30466C3.14989 4.22013 3.22229 4.13767 3.29656 4.05731L0 0H3L16 16ZM5.35254 6.58774C5.12755 7.00862 5 7.48941 5 8C5 9.65685 6.34315 11 8 11C8.29178 11 8.57383 10.9583 8.84053 10.8807L5.35254 6.58774Z" fill="#000000"></path> <path d="M16 8L14.2278 10.1266L7.63351 2.01048C7.75518 2.00351 7.87739 2 8 2C9.90091 2 11.7036 2.84434 12.9206 4.30466L16 8Z" fill="#000000"></path> 
                            </g>
                        </svg>
                    </span>
                </div>
            </div>

            {{-- Mata Pelajaran chips --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Mata Pelajaran</label>
                <div class="flex flex-wrap gap-2" id="edit-mp-chips">
                    @foreach ($mps as $mp)
                        <button type="button"
                            data-id="{{ $mp->id }}"
                            onclick="toggleChip(this, 'edit-mp-inputs', 'mps[]')"
                            class="edit-chip-mp chip px-3 py-1 rounded-full border border-blue-500
                                text-blue-500 text-sm transition-colors cursor-pointer">
                            {{ $mp->singkatan }}
                        </button>
                    @endforeach
                </div>
                <div id="edit-mp-inputs"></div>
            </div>

            {{-- Kelas chips --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Kelas</label>
                <div class="flex flex-wrap gap-2" id="edit-kelas-chips">
                    @foreach ($kelas as $k)
                        <button type="button"
                            data-id="{{ $k->id }}"
                            onclick="toggleChip(this, 'edit-kelas-inputs', 'kelas[]')"
                            class="edit-chip-kelas chip px-3 py-1 rounded-full border border-green-500
                                text-green-500 text-sm transition-colors cursor-pointer uppercase">
                            {{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}
                        </button>
                    @endforeach
                </div>
                <div id="edit-kelas-inputs"></div>
            </div>

            <h1 class="text-lg font-semibold text-gray-800 mb-4">Data Lainnya</h1>

            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Email</label>
                    <input type="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" name="email" value="" id="editEmail"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <p id="editEmailError" class="text-red-500 text-xs mt-1 hidden">Email sudah terdaftar</p>
                </div>

                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">No. HP</label>
                    <input type="text" inputmode="numeric" pattern="[0-9-]*" name="no_hp" value="" id="editNoHP"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <p id="editNoHPError" class="text-red-500 text-xs mt-1 hidden">No. HP sudah terdaftar</p>
                </div>

                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Perguruan Terakhir</label>
                    <input type="text" name="perguruan" value="" id="editPerguruan"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan" value="" id="editPendidikan"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Alamat</label>
                    <input type="text" name="alamat" value="" id="editAlamat"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                    Batal
                </button>
                <button type="submit" id="editGuruBtn"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2.5 text-sm font-medium transition">
                    Update Data Guru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function setupPasswordToggle(inputId, toggleId) {
    const passwordInput = document.getElementById(inputId);
    const toggleButton = document.getElementById(toggleId);

    if (!passwordInput || !toggleButton) {
        return;
    }

    toggleButton.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleButton.querySelectorAll('svg').forEach(svg => svg.classList.toggle('hidden'));
    });
}

setupPasswordToggle('addPwd', 'addTogglePwd');
setupPasswordToggle('editPwd', 'editTogglePwd');

function toggleChip(button, containerId, inputName) {
    const id       = button.dataset.id;
    const inputDiv = document.getElementById(containerId);
    const existing = inputDiv.querySelector(`input[value="${id}"]`);

    if (existing) {
        existing.remove();
        if (inputName === 'kelas[]') {
            button.classList.remove('bg-green-500', 'text-white');
            button.classList.add('text-green-500');
        } else {
            button.classList.remove('bg-blue-500', 'text-white');
            button.classList.add('text-blue-500');
        }
    } else {
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = inputName;
        input.value = id;
        inputDiv.appendChild(input);
        if (inputName === 'kelas[]') {
            button.classList.add('bg-green-500', 'text-white');
            button.classList.remove('text-green-500');
        } else {
            button.classList.add('bg-blue-500', 'text-white');
            button.classList.remove('text-blue-500');
        }
    }
}

let currentEditId = null;

function openEditModal(button) {
    const id    = button.dataset.id;
    const nip   = button.dataset.nip;
    const nama  = button.dataset.nama;
    const email = button.dataset.email;
    const no_hp = button.dataset.no_hp;
    const perguruan = button.dataset.perguruan;
    const pendidikan = button.dataset.pendidikan;
    const alamat = button.dataset.alamat;

    const assignedMps   = JSON.parse(button.dataset.mps   || '[]');
    const assignedKelas = JSON.parse(button.dataset.kelas || '[]');

    currentEditId = id;
    document.getElementById('editForm').action = `/data-guru/${id}`;
    document.getElementById('edit-nip').value  = nip;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('editEmail').value = email;
    document.getElementById('editNoHP').value = no_hp;
    document.getElementById('editPerguruan').value = perguruan;
    document.getElementById('editPendidikan').value = pendidikan;
    document.getElementById('editAlamat').value = alamat;

    // Reset edit modal chips and inputs only (scoped to edit modal)
    const editModal = document.getElementById('editGuruModal');
    document.getElementById('edit-mp-inputs').innerHTML    = '';
    document.getElementById('edit-kelas-inputs').innerHTML = '';

    editModal.querySelectorAll('.edit-chip-mp').forEach(chip => {
        chip.classList.remove('bg-blue-500', 'text-white');
        chip.classList.add('text-blue-500');
    });
    editModal.querySelectorAll('.edit-chip-kelas').forEach(chip => {
        chip.classList.remove('bg-green-500', 'text-white');
        chip.classList.add('text-green-500');
    });

    // Pre-select — scoped to edit modal only
    assignedMps.forEach(mpId => {
        const chip = editModal.querySelector(`.edit-chip-mp[data-id="${mpId}"]`);
        if (chip) toggleChip(chip, 'edit-mp-inputs', 'mps[]');
    });

    assignedKelas.forEach(kelasId => {
        const chip = editModal.querySelector(`.edit-chip-kelas[data-id="${kelasId}"]`);
        if (chip) toggleChip(chip, 'edit-kelas-inputs', 'kelas[]');
    });

    editModal.classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editGuruModal').classList.add('hidden');
}

// Search
document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#guruTable tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
});

// Check NIP duplication for Add modal
const addNIPInput = document.getElementById('addNIP');
const addNIPError = document.getElementById('addNIPError');
const addEmailInput = document.getElementById('addEmail');
const addEmailError = document.getElementById('addEmailError');
const addNoHPInput = document.getElementById('addNoHP');
const addNoHPError = document.getElementById('addNoHPError');
const addGuruBtn = document.getElementById('addGuruBtn');

addNIPInput.addEventListener('input', async function() {
    this.value = this.value.replace(/[^0-9-]/g, '');
    const nip = this.value.trim();

    if (nip.length === 0) {
        addNIPError.classList.add('hidden');
        addGuruBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("guru.checkDuplicate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ nip: nip })
        });

        const data = await response.json();

        if (data.exists) {
            addNIPError.classList.remove('hidden');
            addGuruBtn.disabled = true;
        } else {
            addNIPError.classList.add('hidden');
            addGuruBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking NIP:', error);
    }
});

addEmailInput.addEventListener('input', async function() {
    const email = this.value.trim();

    if (email.length === 0) {
        addEmailError.classList.add('hidden');
        addGuruBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("guru.checkDuplicate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ email: email })
        });

        const data = await response.json();

        if (data.exists) {
            addEmailError.classList.remove('hidden');
            addGuruBtn.disabled = true;
        } else {
            addEmailError.classList.add('hidden');
            addGuruBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking Email:', error);
    }
});

addNoHPInput.addEventListener('input', async function() {
    this.value = this.value.replace(/[^0-9-]/g, '');
    const no_hp = this.value.trim();

    if (no_hp.length === 0) {
        addNoHPError.classList.add('hidden');
        addGuruBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("guru.checkDuplicate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ no_hp: no_hp })
        });

        const data = await response.json();

        if (data.exists) {
            addNoHPError.classList.remove('hidden');
            addGuruBtn.disabled = true;
        } else {
            addNoHPError.classList.add('hidden');
            addGuruBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking No HP:', error);
    }
});

// Check NIP duplication for Edit modal
const editNIPInput = document.getElementById('edit-nip');
const editNIPError = document.getElementById('editNIPError');
const editEmailInput = document.getElementById('editEmail');
const editEmailError = document.getElementById('editEmailError');
const editNoHPInput = document.getElementById('editNoHP');
const editNoHPError = document.getElementById('editNoHPError');
const editGuruBtn = document.getElementById('editGuruBtn');

editNIPInput.addEventListener('input', async function() {
    this.value = this.value.replace(/[^0-9-]/g, '');
    const nip = this.value.trim();

    if (nip.length === 0) {
        editNIPError.classList.add('hidden');
        editGuruBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("guru.checkDuplicate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ nip: nip })
        });

        const data = await response.json();

        if (data.exists) {
            editNIPError.classList.remove('hidden');
            editGuruBtn.disabled = true;
        } else {
            editNIPError.classList.add('hidden');
            editGuruBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking NIP:', error);
    }
});

editEmailInput.addEventListener('input', async function() {
    const email = this.value.trim();

    if (email.length === 0) {
        editEmailError.classList.add('hidden');
        editGuruBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("guru.checkDuplicate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ email: email })
        });

        const data = await response.json();

        if (data.exists) {
            editEmailError.classList.remove('hidden');
            editGuruBtn.disabled = true;
        } else {
            editEmailError.classList.add('hidden');
            editGuruBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking Email:', error);
    }
});

editNoHPInput.addEventListener('input', async function() {
    this.value = this.value.replace(/[^0-9-]/g, '');
    const no_hp = this.value.trim();

    if (no_hp.length === 0) {
        editNoHPError.classList.add('hidden');
        editGuruBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("guru.checkDuplicate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ no_hp: no_hp })
        });

        const data = await response.json();

        if (data.exists) {
            editNoHPError.classList.remove('hidden');
            editGuruBtn.disabled = true;
        } else {
            editNoHPError.classList.add('hidden');
            editGuruBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking No HP:', error);
    }
});

</script>
@endpush
