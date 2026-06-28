@extends('pages.layout.layout')

@section('title', 'Data Kelas')
@section('header', 'Data Kelas')

@section('content')

@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Top bar --}}
<div class="grid grid-cols-5 gap-4 mb-6">
    <input type="text" id="searchInput"
        placeholder="Masukkan nama kelas"
        class="w-full px-3 py-2 border border-gray-300 rounded-xl
               focus:outline-none focus:ring focus:ring-blue-200 col-span-4">
    <button onclick="document.getElementById('addKelasModal').classList.remove('hidden')"
        class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white
                px-5 py-2 rounded-xl transition">
        Tambah Kelas +
    </button>
</div>

{{-- Table --}}
<div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
    <table class="w-full">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-6 py-4 text-left font-semibold">Nama Kelas</th>
                <th class="px-6 py-4 text-left font-semibold">Jumlah Siswa</th>
                <th class="px-6 py-4 text-left font-semibold">Wali Kelas</th>
                <th class="px-6 py-4 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="kelasTable">
            @forelse ($kelas as $k)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 uppercase font-medium">
                        {{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        {{ $k->siswas->count() }} siswa
                    </td>
                    <td class="px-6 py-4 text-sm">
                        {{ $k->waliKelas?->nama ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button
                            onclick="openEditModal(this)"
                            data-id="{{ $k->id }}"
                            data-nomor="{{ $k->nomor_kelas }}"
                            data-huruf="{{ $k->huruf_kelas }}"
                            data-wali="{{ $k->wali_kelas_id }}"
                            class="text-blue-500 hover:text-blue-700 hover:bg-blue-100
                                   rounded-lg transition px-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form method="POST" action="{{ route('kelas.delete', $k->id) }}"
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
                        Belum ada kelas. Klik "Tambah Kelas" untuk menambahkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


{{-- ADD MODAL --}}
<div id="addKelasModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative">
        <button onclick="document.getElementById('addKelasModal').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Kelas</h2>
        <hr class="mb-4 opacity-30">

        <form method="POST" action="{{ route('kelas.simpan') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nomor Kelas</label>
                    <select name="nomor_kelas"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="" disabled selected>— pilih —</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Huruf Kelas</label>
                    <input type="text" name="huruf_kelas" placeholder="A"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400"
                        maxlength="2" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Wali Kelas</label>
                <select name="wali_kelas_id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">— Pilih Wali Kelas (opsional) —</option>
                    @foreach ($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button"
                    onclick="document.getElementById('addKelasModal').classList.add('hidden')"
                    class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50
                           rounded-xl py-2.5 text-sm font-medium transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white
                           rounded-xl py-2.5 text-sm font-medium transition">
                    Tambah Kelas
                </button>
            </div>
        </form>
    </div>
</div>


{{-- EDIT MODAL --}}
<div id="editKelasModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative">
        <button onclick="closeEditModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Kelas</h2>
        <hr class="mb-4 opacity-30">

        <form method="POST" id="editForm" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nomor Kelas</label>
                    <select name="nomor_kelas" id="edit-nomor"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Huruf Kelas</label>
                    <input type="text" name="huruf_kelas" id="edit-huruf"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400"
                        maxlength="2" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Wali Kelas</label>
                <select name="wali_kelas_id" id="edit-wali"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">— Tidak ada —</option>
                    @foreach ($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50
                           rounded-xl py-2.5 text-sm font-medium transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white
                           rounded-xl py-2.5 text-sm font-medium transition">
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
    const id    = button.dataset.id;
    const nomor = button.dataset.nomor;
    const huruf = button.dataset.huruf;
    const wali  = button.dataset.wali;

    document.getElementById('editForm').action  = `/datakelas/${id}`;
    document.getElementById('edit-nomor').value = nomor;
    document.getElementById('edit-huruf').value = huruf;
    document.getElementById('edit-wali').value  = wali || '';

    document.getElementById('editKelasModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editKelasModal').classList.add('hidden');
}

// Search
document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#kelasTable tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
});
</script>
@endpush
