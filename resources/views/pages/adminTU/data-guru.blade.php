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
                    <input type="text" name="NIP" value="{{ old('NIP') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="col-span-3">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Password</label>
                <input type="text" name="password" value="{{ old('password') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
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

            <div class="flex gap-3 pt-2">
                <button type="button"
                        onclick="document.getElementById('addGuruModal').classList.add('hidden')"
                        class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                    Batal
                </button>
                <button type="submit"
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
                    <input type="text" id="edit-nip" name="nip"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div class="col-span-3">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                    <input type="text" id="edit-nama" name="nama"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Password Baru
                    <span class="text-gray-400 font-normal text-xs">(kosongkan jika tidak diubah)</span>
                </label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
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
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                    Batal
                </button>
                <button type="submit"
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

function openEditModal(button) {
    const id    = button.dataset.id;
    const nip   = button.dataset.nip;
    const nama  = button.dataset.nama;

    const assignedMps   = JSON.parse(button.dataset.mps   || '[]');
    const assignedKelas = JSON.parse(button.dataset.kelas || '[]');

    document.getElementById('editForm').action = `/dataguru/${id}`;
    document.getElementById('edit-nip').value  = nip;
    document.getElementById('edit-nama').value = nama;

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
</script>
@endpush
