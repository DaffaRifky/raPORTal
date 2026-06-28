@extends('pages.layout.layout')

@section('title', 'Kelola Tugas')
@section('header', 'Kelola Tugas')

@section('content')

@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Top bar --}}
<div class="grid grid-cols-5 gap-4 mb-6">
            <input type="text" id="searchInput"
            placeholder="Masukkan Nama Tugas"
            class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200 col-span-4">

    <button onclick="document.getElementById('addModal').classList.remove('hidden')"
        class="px-4 py-2.5 bg-blue-600 text-white rounded-xl
               hover:bg-blue-700 transition">
        Tambah Tugas +
    </button>
</div>

{{-- Table --}}
<div class="border border-gray-200 rounded-2xl overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-6 py-4 text-left font-semibold">Nama Tugas</th>
                <th class="px-6 py-4 text-left font-semibold">Mata Pelajaran</th>
                <th class="px-6 py-4 text-left font-semibold">Tipe</th>
                <th class="px-6 py-4 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="tugasTable">
            @forelse ($tugasList as $tugas)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm">{{ $tugas->nama }}</td>
                    <td class="px-6 py-4 text-sm">{{ $tugas->mp->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $tipeColor = match($tugas->tipe) {
                                'UH'    => 'bg-orange-100 text-orange-700',
                                'UTS'   => 'bg-purple-100 text-purple-700',
                                'UAS'   => 'bg-red-100 text-red-700',
                                default => 'bg-blue-100 text-blue-700',
                            };
                        @endphp
                        <span class="px-2 py-0.5 rounded-full text-xs {{ $tipeColor }}">
                            {{ $tugas->tipe }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{-- Edit button --}}
                        <button
                            onclick="openEditModal(this)"
                            data-id="{{ $tugas->id }}"
                            data-nama="{{ $tugas->nama }}"
                            data-tipe="{{ $tugas->tipe }}"
                            data-mp="{{ $tugas->mp_id }}"
                            class="text-blue-500 hover:text-blue-700 hover:bg-blue-100
                                   rounded-lg transition px-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>

                        {{-- Delete button --}}
                        <form method="POST" action="{{ route('tugas.delete', $tugas->id) }}"
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus tugas ini? Semua nilai terkait juga akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-500 hover:text-red-700 hover:bg-red-100
                                       rounded-lg transition px-1">
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
                        Belum ada tugas. Klik "+ Tambah Tugas" untuk menambahkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


{{-- ===== ADD MODAL ===== --}}
<div id="addModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-bold text-gray-800">Tambah Tugas</h2>
            <button onclick="document.getElementById('addModal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>

        <form method="POST" action="{{ route('tugas.simpan') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama Tugas</label>
                <input type="text" name="nama" placeholder="contoh: Tugas 1, UH Bab 2"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Tipe</label>
                <select name="tipe"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="Tugas">Tugas Harian</option>
                    <option value="UH">Ulangan Harian (UH)</option>
                    <option value="UTS">UTS</option>
                    <option value="UAS">UAS</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Mata Pelajaran</label>
                <select name="mp_id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="" selected disabled>-- Pilih Mata Pelajaran --</option>
                    @foreach ($mps as $mp)
                        <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button"
                    onclick="document.getElementById('addModal').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-gray-600 border border-gray-300
                           rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600
                           rounded-xl hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


{{-- ===== EDIT MODAL ===== --}}
<div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-bold text-gray-800">Edit Tugas</h2>
            <button onclick="closeEditModal()"
                class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>

        <form method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama Tugas</label>
                <input type="text" name="nama" id="edit-nama"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Tipe</label>
                <select name="tipe" id="edit-tipe"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="Tugas">Tugas Harian</option>
                    <option value="UH">Ulangan Harian (UH)</option>
                    <option value="UTS">UTS</option>
                    <option value="UAS">UAS</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Mata Pelajaran</label>
                <select name="mp_id" id="edit-mp"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach ($mps as $mp)
                        <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 text-sm text-gray-600 border border-gray-300
                           rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600
                           rounded-xl hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openEditModal(button) {
    const id   = button.dataset.id;
    const nama = button.dataset.nama;
    const tipe = button.dataset.tipe;
    const mp   = button.dataset.mp;

    document.getElementById('editForm').action = `/kelola-tugas/${id}`;
    document.getElementById('edit-nama').value  = nama;
    document.getElementById('edit-tipe').value  = tipe;
    document.getElementById('edit-mp').value    = mp;

    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Search
document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#tugasTable tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
});
</script>
@endpush
