@extends('pages.layout.layout')

@section('title', 'Penilaian Siswa')
@section('header', 'Penilaian Siswa')

@section('content')

{{-- ===== SEARCH + FILTERS ===== --}}
<div class="flex gap-4 mb-4">
    <input type="text" id="searchInput"
        placeholder="Masukan Nama atau NIS"
        class="flex-1 px-4 py-2.5 border border-gray-300 rounded-xl text-sm
               focus:outline-none focus:ring-2 focus:ring-blue-400">

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

{{-- ===== TABLE ===== --}}
<div class="border border-gray-200 rounded-2xl overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-4 text-left font-semibold text-sm w-28">NIS</th>
                <th class="px-4 py-4 text-left font-semibold text-sm">Nama Siswa</th>

                @forelse ($tugasList as $tugas)
                    <th class="px-4 py-4 text-center font-semibold text-sm whitespace-nowrap">
                        <span class="block">{{ $tugas->nama }}</span>
                        <span class="text-xs font-normal text-gray-400">{{ $tugas->tipe }}</span>
                    </th>
                @empty
                    <th class="px-4 py-4 text-center font-semibold text-sm text-gray-400">
                        Nilai
                    </th>
                @endforelse

                <th class="px-4 py-4 text-center font-semibold text-sm bg-blue-50 text-blue-700">
                    Rata-Rata
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="siswaTable">
            @forelse ($siswas as $siswa)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $siswa->NIS }}</td>
                    <td class="px-4 py-3 text-sm ">{{ $siswa->nama }}</td>

                    @forelse ($tugasList as $tugas)
                        @php $score = $siswa->scores[$tugas->id] ?? null; @endphp
                        <td class="px-4 py-3 text-center text-sm">
                            @if ($score !== null)
                                <span class="font-medium">
                                    {{ $score }}
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                    @empty
                        <td class="px-4 py-3 text-center text-sm text-gray-300">-</td>
                    @endforelse

                    <td class="px-4 py-3 text-center bg-blue-50">
                        @if ($siswa->rata_rata !== null)
                            <span class="font-bold text-sm
                                {{ $siswa->rata_rata }}">
                                {{ $siswa->rata_rata }}
                            </span>
                        @else
                            <span class="text-gray-300 text-sm">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $tugasList->count() + 3 }}"
                        class="px-6 py-8 text-center text-gray-400 text-sm">
                        Belum ada siswa di kelas ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
// One function, takes both the key and value — no name collision
function applyFilter(key, value) {
    const url = new URL(window.location.href);
    url.searchParams.set(key, value);
    window.location.href = url.toString();
}

document.getElementById('searchInput')?.addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#siswaTable tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
});
</script>
@endpush
