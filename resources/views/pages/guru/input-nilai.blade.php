@extends('pages.layout.layout')

@section('title', 'Input Nilai')
@section('header', 'Input Nilai')

@section('content')

{{-- Search --}}
<input type="text" id="searchInput"
    placeholder="Masukan Nama atau NIS"
    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl mb-4
           focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">

{{-- Dropdown filters — reload page with selected values --}}
<div class="grid grid-cols-3 gap-4 mb-6">

    {{-- Pilih Mata Pelajaran --}}
    <div>
        <label class="block text-xs text-gray-500 mb-1">Pilih Mata Pelajaran</label>
        <select onchange="applyFilter('mp_id', this.value)"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-400">
            @foreach ($myMps as $mp)
                <option value="{{ $mp->id }}" {{ $mp->id == $selectedMpId ? 'selected' : '' }}>
                    {{ $mp->nama }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Pilih Tugas --}}
    <div>
        <label class="block text-xs text-gray-500 mb-1">Pilih Tugas</label>
        <select onchange="applyFilter('tugas_id', this.value)"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-400">
            @forelse ($tugasList as $tugas)
                <option value="{{ $tugas->id }}" {{ $tugas->id == $selectedTugasId ? 'selected' : '' }}>
                    {{ $tugas->nama }} ({{ $tugas->tipe }})
                </option>
            @empty
                <option value="">-- Tidak ada tugas --</option>
            @endforelse
        </select>
    </div>

    {{-- Pilih Kelas --}}
    <div>
        <label class="block text-xs text-gray-500 mb-1">Pilih Kelas</label>
        <select onchange="applyFilter('kelas_id', this.value)"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-400">
            @foreach ($myKelas as $k)
                <option class="uppercase" value="{{ $k->id }}" {{ $k->id == $selectedKelasId ? 'selected' : '' }}>
                    {{ $k->nomor_kelas }} - {{ $k->huruf_kelas }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- Table --}}
<div class="border border-gray-200 rounded-2xl overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-6 py-4 text-left font-semibold">NIS</th>
                <th class="px-6 py-4 text-left font-semibold">Nama Siswa</th>
                <th class="px-6 py-4 text-left font-semibold">Nilai</th>
                <th class="px-6 py-4 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="nilaiTable">
            @forelse ($siswas as $siswa)
                <tr class="hover:bg-gray-50 transition" id="row-{{ $siswa->id }}">
                    <td class="px-6 py-4 text-sm">{{ $siswa->NIS }}</td>
                    <td class="px-6 py-4 text-sm">{{ $siswa->nama }}</td>

                    {{-- Nilai cell --}}
                    <td class="px-6 py-4 text-sm" id="nilai-cell-{{ $siswa->id }}">
                        <span id="nilai-display-{{ $siswa->id }}">
                            {{ $siswa->nilai?->nilai ?? '-' }}
                        </span>
                        <input type="number"
                            id="nilai-input-{{ $siswa->id }}"
                            value="{{ $siswa->nilai?->nilai ?? '' }}"
                            min="0" max="100" step="0.5"
                            class="hidden w-24 border border-gray-300 rounded-lg px-3 py-1.5
                                   text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </td>

                    {{-- Action cell --}}
                    <td class="px-6 py-4 text-center" id="action-cell-{{ $siswa->id }}">
                        {{-- Default button (Input or Edit) --}}
                        <button id="btn-edit-{{ $siswa->id }}"
                            onclick="startEdit({{ $siswa->id }})"
                            class="px-3 py-1.5 rounded-lg text-xs font-medium text-white
                                   {{ $siswa->nilai ? 'bg-yellow-400 hover:bg-yellow-500' : 'bg-blue-500 hover:bg-blue-600' }}">
                            {{ $siswa->nilai ? 'Edit Nilai' : 'Input Nilai' }}
                        </button>

                        {{-- Simpan + Batal (hidden by default) --}}
                        <button id="btn-simpan-{{ $siswa->id }}"
                            onclick="saveNilai({{ $siswa->id }}, {{ $selectedTugasId ?? 'null' }})"
                            class="hidden px-3 py-1.5 rounded-lg text-xs font-medium
                                   text-white bg-green-500 hover:bg-green-600">
                            Simpan
                        </button>
                        <button id="btn-batal-{{ $siswa->id }}"
                            onclick="cancelEdit({{ $siswa->id }})"
                            class="hidden px-3 py-1.5 rounded-lg text-xs font-medium
                                   text-white bg-gray-400 hover:bg-gray-500">
                            Batal
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">
                        Pilih kelas dan tugas untuk menampilkan data siswa
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
// Build current URL params
const urlParams = new URLSearchParams(window.location.search);

// When a dropdown changes, update its URL param and reload
function applyFilter(key, value) {
    urlParams.set(key, value);
    // If MP changes, remove tugas_id so it resets
    if (key === 'mp_id') urlParams.delete('tugas_id');
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}

// Toggle row into edit mode
function startEdit(siswaId) {
    document.getElementById(`nilai-display-${siswaId}`).classList.add('hidden');
    document.getElementById(`nilai-input-${siswaId}`).classList.remove('hidden');
    document.getElementById(`btn-edit-${siswaId}`).classList.add('hidden');
    document.getElementById(`btn-simpan-${siswaId}`).classList.remove('hidden');
    document.getElementById(`btn-batal-${siswaId}`).classList.remove('hidden');
    document.getElementById(`nilai-input-${siswaId}`).focus();
}

// Cancel — restore original display
function cancelEdit(siswaId) {
    document.getElementById(`nilai-display-${siswaId}`).classList.remove('hidden');
    document.getElementById(`nilai-input-${siswaId}`).classList.add('hidden');
    document.getElementById(`btn-edit-${siswaId}`).classList.remove('hidden');
    document.getElementById(`btn-simpan-${siswaId}`).classList.add('hidden');
    document.getElementById(`btn-batal-${siswaId}`).classList.add('hidden');
}

// Save score via fetch (no page reload)
async function saveNilai(siswaId, tugasId) {
    const nilaiInput = document.getElementById(`nilai-input-${siswaId}`);
    const nilai      = nilaiInput.value;

    if (nilai === '' || isNaN(nilai)) {
        alert('Masukan nilai yang valid (0-100)');
        return;
    }

    const response = await fetch('{{ route("guru.simpan-nilai") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
            siswa_id: siswaId,
            tugas_id: tugasId,
            nilai:    parseFloat(nilai),
        }),
    });

    const result = await response.json();

    if (result.success) {
        // Update display without reload
        document.getElementById(`nilai-display-${siswaId}`).textContent = nilai;

        // Change button to yellow "Edit"
        const editBtn = document.getElementById(`btn-edit-${siswaId}`);
        editBtn.textContent = 'Edit';
        editBtn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
        editBtn.classList.add('bg-yellow-400', 'hover:bg-yellow-500');

        cancelEdit(siswaId);
    } else {
        alert('Gagal menyimpan nilai. Silakan coba lagi.');
    }
}

// Search filter
document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#nilaiTable tr').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
    });
});
</script>
@endpush
