@extends('pages.layout.layout')

@section('title', 'Kelas Saya')
@section('header', 'Kelas Saya')

@section('content')


@if (!$kelas)
    {{-- Not assigned as wali kelas --}}
    <div class="flex flex-col items-center justify-center py-24 text-gray-400">
        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083
                   12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952
                   11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
        </svg>
        <p class="text-lg font-medium">Anda belum ditugaskan sebagai Wali Kelas</p>
        <p class="text-sm mt-1">Hubungi Admin TU untuk pengaturan wali kelas.</p>
    </div>
@else

{{-- ===== 3 STAT CARDS ===== --}}
<div class="container">
    <div class="mb-6 p-6 bg-[#E2E2E2] rounded-lg shadow-md">
        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 rounded-2xl px-6 py-3">
                <p class="text-xs text-gray-500 mb-1">Kelas</p>
                <p class="text-3xl font-bold text-gray-800 uppercase">
                    {{ $kelas->nomor_kelas }} - {{ $kelas->huruf_kelas }}
                </p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl px-6 py-3">
                <p class="text-xs text-gray-500 mb-1">Jumlah Siswa</p>
                <p class="text-3xl font-bold text-gray-800">{{ $siswas->count() }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl px-6 py-3">
                <p class="text-xs text-gray-500 mb-1">Rata-rata Keseluruhan Siswa</p>
                <p class="text-3xl font-bold text-gray-800">
                    {{ $classAverage ?? '-' }}
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ===== SEARCH + MP FILTER ===== --}}
<div class="flex gap-4 mb-4">
    <input type="text" id="searchInput"
        placeholder="Masukan Nama atau NIS"
        class="flex-1 px-4 py-2.5 border border-gray-300 rounded-xl text-sm
               focus:outline-none focus:ring-2 focus:ring-blue-400">

    <div class="w-64">
        <select onchange="applyFilter(this.value)"
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

                {{-- Dynamic task columns --}}
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
                    <td class="px-4 py-3 text-sm uppercase font-medium">{{ $siswa->nama }}</td>

                    @forelse ($tugasList as $tugas)
                        @php $score = $siswa->scores[$tugas->id] ?? null; @endphp
                        <td class="px-4 py-3 text-center text-sm">
                            @if ($score !== null)
                                <span class="font-medium ">
                                    {{ $score }}
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                    @empty
                        <td class="px-4 py-3 text-center text-sm text-gray-300">-</td>
                    @endforelse

                    {{-- Rata-rata per student --}}
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
@endif

@endsection

@push('scripts')
<script>
function applyFilter(mpId) {
    const url = new URL(window.location.href);
    url.searchParams.set('mp_id', mpId);
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
