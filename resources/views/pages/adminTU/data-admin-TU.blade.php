@extends('pages.layout.layout')

@section('title', 'Data Admin TU')
@section('header', 'Data Admin TU')

@section('content')

@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-5 gap-4 mb-6">
    <input type="text" id="searchInput"
    placeholder="Masukkan Nama atau NIP"
    class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200 col-span-4">
    <a onclick="document.getElementById('addAdminTUModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl text-center">Tambah Admin TU +</a>
</div>
<div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
    <table class="table-auto w-full">
        <thead class="bg-indigo-50 text-indigo-700 font-medium">
            <tr>
                <th class="text-start px-4 py-3 font-semibold">NIP</th>
                <th class="text-start px-4 py-3 font-semibold">Nama</th>
                <th class="px-4 py-3 font-semibold text-center">Action</th>
            </tr>
        </thead>
        <tbody id="adminTUTable" class="divide-y divide-black/10">
            @foreach ($adminTUs as $adminTU)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3">{{ $adminTU->nip }}</td>
                <td class="px-4 py-3">{{ $adminTU->nama }}</td>
                <td class="px-6 py-4 text-center">
                        <button onclick=" openEditModal(
                        {{ $adminTU->id }},
                         '{{ $adminTU->nip }}',
                         '{{ $adminTU->nama }}',
                         '{{ $adminTU->email }}',
                         '{{ $adminTU->no_hp }}',
                         '{{ $adminTU->perguruan }}',
                         '{{ $adminTU->pendidikan }}',
                         '{{ $adminTU->alamat }}'
                         )"
                        class="text-blue-500 hover:text-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form method="POST" action="{{ route('admin-TU.delete', $adminTU->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" text-red-500 hover:bg-red-100 rounded-lg transition" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                            </button>
                        </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- modal tambah admin TU --}}
<div id="addAdminTUModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
<div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
    <button onclick="document.getElementById('addAdminTUModal').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Admin TU Baru</h2>
    <hr class="mb-4 opacity-30 border">

    <form method="POST" action="{{ route('admin-TU.simpan') }}" class="space-y-4">
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
                    onclick="document.getElementById('addAdminTUModal').classList.add('hidden')"
                    class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                Cancel
            </button>
            <button type="submit"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2.5 text-sm font-medium transition" id="addAdminTUBtn">
                Tambah Admin TU
            </button>
        </div>
    </form>
</div>
</div>

{{-- modal edit TU --}}
<div id="editAdminTUModal"
class="fixed flex inset-0 bg-black/50 items-center justify-center z-50 p-4 hidden ">
<div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
    <button onclick="document.getElementById('editAdminTUModal').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Admin TU</h2>
    <hr class="mb-4 opacity-30 border">

    <form id="editAdminTUForm" method="POST" action="" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-5 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">NIP</label>
                <input type="text" inputmode="numeric" pattern="[0-9-]*" name="NIP" value="" id="editNIP" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                <p id="editNIPError" class="text-red-500 text-xs mt-1 hidden">NIP sudah terdaftar</p>
            </div>

            <div class="col-span-3">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama</label>
                <input type="text" name="nama" value="" id="editNama" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1.5">Password
                <span class="text-gray-400 font-normal text-xs">(kosongkan jika tidak diubah)</span>
            </label>
            <div class="flex gap-2 items-center">
                <input type="password" pattern=".{8,}" id="editPwd" name="password" value="{{ old('password') }}"
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

        <div class="flex gap-3 pt-2">
            <button type="button"
                    onclick="document.getElementById('editAdminTUModal').classList.add('hidden')"
                    class="flex-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl py-2.5 text-sm font-medium transition">
                Cancel
            </button>
            <button type="submit"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2.5 text-sm font-medium transition" id="editAdminTUBtn">
                Update Data Admin TU
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

let currentEditId = null;

function openEditModal(id, nip, nama, email, no_hp, perguruan, pendidikan, alamat) {
    currentEditId = id;
    document.getElementById('editNIP').value       = nip;
    document.getElementById('editNama').value      = nama;
    document.getElementById('editEmail').value     = email;
    document.getElementById('editNoHP').value      = no_hp;
    document.getElementById('editPerguruan').value = perguruan;
    document.getElementById('editPendidikan').value = pendidikan;
    document.getElementById('editAlamat').value    = alamat;
    document.getElementById('editAdminTUForm').action  = '/data-admin-TU/' + id;
    document.getElementById('editAdminTUModal').classList.remove('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    @if(isset($adminTU))
    const editModal = document.getElementById('editAdminTUModal');
    // if (editModal) {
    //     editModal.classList.remove('hidden');
    // }
    @endif
});

document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#adminTUTable tr').forEach(row => {
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
const addAdminTUBtn = document.getElementById('addAdminTUBtn');

addNIPInput.addEventListener('input', async function() {
    this.value = this.value.replace(/[^0-9-]/g, '');
    const nip = this.value.trim();

    if (nip.length === 0) {
        addNIPError.classList.add('hidden');
        addAdminTUBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("admin-TU.checkDuplicate") }}', {
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
            addAdminTUBtn.disabled = true;
        } else {
            addNIPError.classList.add('hidden');
            addAdminTUBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking NIP:', error);
    }
});

addEmailInput.addEventListener('input', async function() {
    const email = this.value.trim();

    if (email.length === 0) {
        addEmailError.classList.add('hidden');
        addAdminTUBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("admin-TU.checkDuplicate") }}', {
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
            addAdminTUBtn.disabled = true;
        } else {
            addEmailError.classList.add('hidden');
            addAdminTUBtn.disabled = false;
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
        addAdminTUBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("admin-TU.checkDuplicate") }}', {
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
            addAdminTUBtn.disabled = true;
        } else {
            addNoHPError.classList.add('hidden');
            addAdminTUBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking No HP:', error);
    }
});

// Check NIP duplication for Edit modal
const editNIPInput = document.getElementById('editNIP');
const editNIPError = document.getElementById('editNIPError');
const editEmailInput = document.getElementById('editEmail');
const editEmailError = document.getElementById('editEmailError');
const editNoHPInput = document.getElementById('editNoHP');
const editNoHPError = document.getElementById('editNoHPError');
const editAdminTUBtn = document.getElementById('editAdminTUBtn');

editNIPInput.addEventListener('input', async function() {
    this.value = this.value.replace(/[^0-9-]/g, '');
    const nip = this.value.trim();

    if (nip.length === 0) {
        editNIPError.classList.add('hidden');
        editAdminTUBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("admin-TU.checkDuplicate") }}', {
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
            editAdminTUBtn.disabled = true;
        } else {
            editNIPError.classList.add('hidden');
            editAdminTUBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking NIP:', error);
    }
});

editEmailInput.addEventListener('input', async function() {
    const email = this.value.trim();

    if (email.length === 0) {
        editEmailError.classList.add('hidden');
        editAdminTUBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("admin-TU.checkDuplicate") }}', {
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
            editAdminTUBtn.disabled = true;
        } else {
            editEmailError.classList.add('hidden');
            editAdminTUBtn.disabled = false;
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
        editAdminTUBtn.disabled = false;
        return;
    }

    try {
        const response = await fetch('{{ route("admin-TU.checkDuplicate") }}', {
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
            editAdminTUBtn.disabled = true;
        } else {
            editNoHPError.classList.add('hidden');
            editAdminTUBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error checking No HP:', error);
    }
});

</script>
@endpush
