@extends('pages.layout.layout')

@section('title', 'Data Siswa')
@section('header', 'Data Siswa')

@section('content')

@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-5 gap-4 mb-6">
    <input type="text" id="searchInput"
    placeholder="Masukkan Nama atau NIS"
    class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200 col-span-4">
    <button
        onclick="document.getElementById('addSiswaModal').classList.remove('hidden')"
        class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">
        Tambah Siswa +
    </button>
</div>

<div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
    <table class="w-full">
        <thead class="bg-gray-100 text-gray-600 font-medium">
            <tr>
                <th class="px-6 py-4 text-left font-semibold">NIS</th>
                <th class="px-6 py-4 text-left font-semibold">Nama</th>
                <th class="px-6 py-4 text-left font-semibold">Kelas</th>
                <th class="px-6 py-4 text-center font-semibold">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="siswaTable">
            @foreach ($data as $siswa)
                <tr class="hover:bg-gray-50 transition">
                    <td >{{ $siswa->NIS }}</td>
                    <td >{{ $siswa->nama }}</td>
                    <td class="uppercase">{{ $siswa->kelas->nomor_kelas }} - {{ $siswa->kelas->huruf_kelas }}</td>
                    <td class="flex justify-center gap-3">
                        <a onclick=" openEditModal({{ $siswa->id }}, '{{ $siswa->NIS }}', '{{ $siswa->nama }}', '{{ $siswa->kelas_id }}')"
                            class=" text-blue-500 hover:bg-blue-100 rounded-lg transition"
                            title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('siswa.delete', $siswa->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" text-red-500 hover:bg-red-100 rounded-lg transition" title="Delete">
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

{{-- modal tambah siswa --}}
<div id="addSiswaModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
<div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
    <button onclick="document.getElementById('addSiswaModal').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Siswa Baru</h2>
    <hr class="mb-4 opacity-30 border">

    <form method="POST" action="{{ route('siswa.simpan') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-5 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">NIS</label>
                <input type="text" name="NIS" value="{{ old('NIS') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Kelas</label>
                <select name="kelas"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option disabled selected >—</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ old('kelas') === $k->id ? 'selected' : '' }}>
                            {{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}
                        </option>
                    @endforeach
                </select>
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

{{-- modal edit siswa --}}
<div id="editSiswaModal"
class="fixed flex inset-0 bg-black/50 items-center justify-center z-50 p-4 hidden ">
<div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
    <button onclick="document.getElementById('editSiswaModal').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Siswa</h2>
    <hr class="mb-4 opacity-30 border">

    <form id="editSiswaForm" method="POST" action="" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">NIS</label>
                <input type="text" name="NIS" value="" id="editNIS"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                <input type="text" name="nama" value="" id="editNama"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Kelas</label>
                <select name="kelas" id="editKelas"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id}}" {{ old('kelas') === $k->id ? 'selected' : '' }}>
                            {{ strtoupper($k->nomor_kelas) }} - {{ strtoupper($k->huruf_kelas) }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="flex gap-3 pt-2">
            <button type="button"
                    onclick="document.getElementById('editSiswaModal').classList.add('hidden')"
                    class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                Cancel
            </button>
            <button type="submit"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2.5 text-sm font-medium transition">
                Update Data siswa
            </button>
        </div>
    </form>
</div>
</div>

@endsection

@push('scripts')
<script>
function openEditModal(id, NIS, nama, kelas) {
    document.getElementById('editNIS').value       = NIS;
    document.getElementById('editNama').value      = nama;
    document.getElementById('editKelas').value       = kelas;
    document.getElementById('editSiswaForm').action  = '/datasiswa/' + id;
    document.getElementById('editSiswaModal').classList.remove('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    @if(isset($siswa))
    const editModal = document.getElementById('editSiswaModal');
    // if (editModal) {
    //     editModal.classList.remove('hidden');
    // }
    @endif
});
document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#siswaTable tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
});
</script>
@endpush
