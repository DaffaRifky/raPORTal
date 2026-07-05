@extends('pages.layout.layout')

@section('title', 'Rapor Siswa')
@section('header', 'Rapor Siswa')

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

{{-- ===== STUDENT SELECTOR ===== --}}
<form method="GET" action="{{ route('wali-kelas.rapor') }}">
    <x-selectStudent
        name="nis"
        :items="$siswas"
        value-field="nis"
        label-field="nama"
        :selected="$selectedNis"
        placeholder="Pilih Siswa..."
        :submit-on-select="true"
    />
</form>

<div class="bg-amber-100 p-8 w-4xl mt-8">

{{-- ===== STUDENT NAME HEADER ===== --}}
@if ($selectedSiswa)
    <div class="flex gap-30">
        <table class="[&_td]:!border-0">
            <tbody>
                <tr>
                    <td>Nama Peserta Didik</td>
                    <td class="w-1 text-left">:</td>
                    <td>{{ $selectedSiswa->nama }}</td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td class="w-1 text-left">:</td>
                    <td>{{ $selectedSiswa->nis }}</td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td class="w-1 text-left">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td class="w-1 text-left">:</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table class="[&_td]:!border-0">
            <tbody>
                <tr>
                    <td>Kelas</td>
                    <td class="w-1 text-left">:</td>
                    <td>{{ $kelas->nomor_kelas }} - {{ $kelas->huruf_kelas }}</td>
                </tr>
                <tr>
                    <td>Fase</td>
                    <td class="w-1 text-left">:</td>
                    <td>@if ($kelas->nomor_kelas === 10) E @else F @endif</td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td class="w-1 text-left">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tahun Ajaran</td>
                    <td class="w-1 text-left">:</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endif



{{-- ===== RAPOR TABLE ===== --}}
<div class="overflow-x-auto mt-4">
    <table class="w-full border-collapse [&_td]:!border-4 [&_td]:!border-white [&_th]:!border-4 [&_th]:!border-white overflow-x-auto">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-4 text-center font-semibold text-sm w-10">No.</th>
                <th class="px-4 py-4 text-center font-semibold text-sm w-1/3">Mata Pelajaran</th>
                <th class="px-4 py-4 text-center font-semibold text-sm bg-blue-50 text-blue-700 w-15">Nilai <br> Akhir</th>
                {{-- <th class="px-4 py-4 text-center font-semibold text-sm w-28 bg-blue-50 text-blue-700">Predikat</th> --}}
                <th class="px-4 py-4 text-center font-semibold text-sm bg-blue-50 text-blue-700 " >Capaian Kompetensi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($allMps as $mp)
                @php
                    $score     = $mpScores[$mp->id]['rata_rata'] ?? null;
                    $predikat  = $mpScores[$mp->id]['predikat']  ?? '-';

                    // Colour the predikat badge
                    $badgeClass = match($predikat) {
                        'A'     => 'bg-green-100 text-green-700',
                        'B'     => 'bg-blue-100 text-blue-700',
                        'C'     => 'bg-yellow-100 text-yellow-700',
                        'D'     => 'bg-red-100 text-red-700',
                        'E'     => 'bg-red-300 text-red-900',
                        default => 'bg-gray-100 text-gray-400',
                    };
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm text-gray-400 text-center">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $mp->nama }}</td>

                    <td class="px-4 py-3 text-center bg-blue-50">
                        @if ($score !== null)
                            <span class="font-bold text-sm text-gray-800">{{ $score }}</span>
                        @else
                            <span class="text-gray-300 text-sm">-</span>
                        @endif
                    </td>

                    {{-- <td class="px-4 py-3 text-center bg-blue-50">
                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                            {{ $predikat }}
                        </span>
                    </td> --}}

                    <td class="px-4 py-3 text-center bg-blue-50 "><textarea name="capaian_kompetensi[]" rows="1" id=""class="w-full resize-none overflow-hidden" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-400">
                        Belum ada mata pelajaran.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

        {{-- EXTRAKULIKULER TABLE --}}
        <table class="border border-gray-200 rounded-2xl overflow-x-auto mt-4 w-full [&_td]:!border-4 [&_td]:!border-white [&_th]:!border-4 [&_th]:!border-white overflow-x-auto">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-4 text-center font-semibold text-sm w-10">No.</th>
                    <th class="px-4 py-4 text-center font-semibold text-sm w-1/4">Ekstrakulikuler</th>
                    <th class="px-4 py-4 text-center font-semibold text-sm w-full" colspan="2">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="data-row">
                    <td class="text-center">1</td>
                    <td>P5BK</td>
                    <td colspan="2"><input type="text" class="w-full"></td>
                </tr>
                <tr class="data-row">
                    <td class="text-center">2</td>
                    <td>Pramuka</td>
                    <td colspan="2"><input type="text" class="w-full"></td>
                </tr>
                <tr class="add-row-tr">
                    <td colspan="3" class=""><button type="button" onclick="addRow(this)" class="text-white bg-blue-400 hover:bg-blue-500 rounded-2xl px-4 py-2 text-center">Tambah Ekstrakulikuler</button></td>
                </tr>
            </tbody>
        </table>


        {{-- KETIDAK HADIRAN TABLE --}}
        <table class="border border-gray-200 rounded-2xl overflow-x-auto mt-4 w-auto [&_td]:!border-4 [&_td]:!border-white [&_th]:!border-4 [&_th]:!border-white overflow-x-auto">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-4 text-center font-semibold text-sm w-10" colspan="3">Ketidak Hadiran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td>Sakit</td>
                    <td><input type="text" class="w-full"></td>
                </tr>
                <tr>
                    <td>Izin</td>
                    <td><input type="text" class="w-full"></td>
                </tr>
                <tr>
                    <td>Nihil</td>
                    <td><input type="text" class="w-full"></td>
                </tr>
            </tbody>
        </table>
</div>

@stack('scripts')
<script>
  function addRow(btn) {
    const addRowTr = btn.closest('tr');      // the row containing the clicked button
    const tbody = addRowTr.closest('tbody');  // its own tbody, not the whole page

    const newRow = document.createElement('tr');
    newRow.classList.add('data-row');
    newRow.innerHTML = `
      <td class="text-center"></td>
      <td><input type="text" name="ekstrakulikuler[]" class="w-full" /></td>
      <td colspan="2">
        <div class="flex gap-2">
          <input type="text" name="keterangan[]" class="w-full" />
          <button type="button" onclick="deleteRow(this)" class="bg-red-500 text-white px-4 rounded-full">X</button>
        </div>
      </td>
    `;

    tbody.insertBefore(newRow, addRowTr);
    renumberRows(tbody);
  }

  function deleteRow(btn) {
    const row = btn.closest('tr');
    const tbody = row.closest('tbody');
    row.remove();
    renumberRows(tbody);
  }

  function renumberRows(tbody) {
    const rows = tbody.querySelectorAll('tr.data-row');
    rows.forEach((row, index) => {
      row.cells[0].textContent = index + 1;
    });
  }
</script>
@endif

@endsection
