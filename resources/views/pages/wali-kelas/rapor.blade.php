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

<div id="raporPrintArea" class="bg-amber-100 w-4xl p-8 mt-8 border-5 border-white m-auto">

{{-- ===== STUDENT NAME HEADER ===== --}}
@if ($selectedSiswa)
    <div class="flex gap-30">
        <table class="[&_td]:!border-0">
            <tbody>
                <tr>
                    <td>Nama Peserta Didik</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">{{ $selectedSiswa->nama }}</td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">{{ $selectedSiswa->nis }}</td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">{{ $pengaturanAkademik->nama_sekolah }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">{{ $pengaturanAkademik->alamat_sekolah }}</td>
                </tr>
            </tbody>
        </table>
        <table class="[&_td]:!border-0">
            <tbody>
                <tr>
                    <td>Kelas</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">{{ $kelas->nomor_kelas }} - {{ $kelas->huruf_kelas }}</td>
                </tr>
                <tr>
                    <td>Fase</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">@if ($kelas->nomor_kelas === 10) E @else F @endif</td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">{{ $pengaturanAkademik->semester }}</td>
                </tr>
                <tr>
                    <td>Tahun Ajaran</td>
                    <td class="w-1 text-left">:</td>
                    <td class=" text-sm text-gray-700">{{ $pengaturanAkademik->tahun_ajaran }}
                </tr>
            </tbody>
        </table>
    </div>
@endif



    {{-- ===== RAPOR TABLE ===== --}}
    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse [&_td]:!border-4 [&_td]:!border-white [&_th]:!border-4 [&_th]:!border-white overflow-x-auto bg-blue-50 ">
            <thead class=" text-blue-700">
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
                    <tr class=" transition">
                        <td class="px-4 py-3 text-sm text-center">{{ $loop->iteration }}</td>
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

                        <td class="px-4 py-3 text-center bg-blue-50 text-sm text-gray-700"><textarea name="capaian_kompetensi[]" rows="1" id=""class="w-full resize-none overflow-hidden" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea></td>
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
    <table class="border border-gray-200 rounded-2xl overflow-x-auto mt-4 w-full [&_td]:!border-4 [&_td]:!border-white [&_th]:!border-4 [&_th]:!border-white overflow-x-auto bg-blue-50">
        <thead class=" text-blue-700">
            <tr>
                <th class="px-4 py-4 text-center font-semibold text-sm w-10">No.</th>
                <th class="px-4 py-4 text-center font-semibold text-sm w-1/4">Ekstrakulikuler</th>
                <th class="px-4 py-4 text-center font-semibold text-sm w-full" colspan="2">Keterangan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <tr class="data-row">
                <td class="text-center px-4 py-3 text-sm text-gray-700">1</td>
                <td class="px-4 py-3 text-sm text-gray-700">P5BK</td>
                <td colspan="2"><input type="text" class="w-full text-sm text-gray-700"></td>
            </tr>
            <tr class="data-row">
                <td class="text-center px-4 py-3 text-sm text-gray-700">2</td>
                <td class="px-4 py-3 text-sm text-gray-700">Pramuka</td>
                <td colspan="2"><input type="text" class="w-full text-sm text-gray-700"></td>
            </tr>
            <tr class="add-row-tr">
                <td colspan="3" class=""><button type="button" onclick="addRow(this)" class="text-white bg-blue-400 hover:bg-blue-500 rounded-2xl px-4 py-2 text-center">Tambah Ekstrakulikuler</button></td>
            </tr>
        </tbody>
    </table>


    {{-- KETIDAK HADIRAN TABLE AND TEMPAT TANGGAL RAPOR --}}
    <div class="grid grid-cols-3">
        <table class="border border-gray-200 rounded-2xl overflow-x-auto mt-4 w-auto [&_td]:!border-4 [&_td]:!border-white [&_th]:!border-4 [&_th]:!border-white overflow-x-auto bg-blue-50 col-span-1">
            <thead class=" text-blue-700">
                <tr>
                    <th class="px-4 py-4 text-center font-semibold text-sm w-10" colspan="3">Ketidak Hadiran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class=" text-sm text-gray-700">Sakit</td>
                    <td><input type="text" class="w-full  text-sm text-gray-700"></td>
                </tr>
                <tr>
                    <td class=" text-sm text-gray-700">Izin</td>
                    <td><input type="text" class="w-full  text-sm text-gray-700"></td>
                </tr>
                <tr>
                    <td class=" text-sm text-gray-700">Nihil</td>
                    <td><input type="text" class="w-full  text-sm text-gray-700"></td>
                </tr>
            </tbody>
        </table>
        <div class="col-span-1 col-start-3 flex flex-col items-center mt-10">
            <p>Tempat, Tanggal Rapor</p>
            <p class=" text-sm text-gray-700">Batam, {{ date('d F Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-3 text-center mt-5 justify-items-center gap-8">
        <div class="flex flex-col items-center">
            <p>TTD Orang Tua Peserta Didik</p>
            <div class="w-30 h-30 m-4"></div>
            <p class="text-sm text-gray-700">___________________________</p>
        </div>
        <div class="flex flex-col items-center mt-15">
            <p>TTD Kepala Sekolah</p>
            @if (empty($kepalaSekolah->tanda_tangan))
                <div class="w-30 h-30 m-4"></div>
            @else
                <img class="image w-30 h-30" src="{{ asset('storage/images/' . $kepalaSekolah->tanda_tangan) }}" alt="signature_image">
            @endif
            <p class="underline text-sm text-gray-700">{{ $kepalaSekolah->nama }}</p>
            <p class=" text-sm text-gray-700">{{ $kepalaSekolah->nip }}</p>
        </div>
        <div class="flex flex-col items-center">
            <p>TTD Wali Kelas</p>
            @if (empty(Auth::user()->tanda_tangan))
                <div class="w-30 h-30 m-4"></div>
            @else
                <img class="image w-30 h-30" src="{{ asset('storage/images/' . auth()->user()->tanda_tangan) }}" alt="signature_image">
            @endif
            <p class="underline text-sm text-gray-700">{{ auth()->user()->nama }}</p>
            <p class=" text-sm text-gray-700">{{ auth()->user()->nip }}</p>
        </div>
    </div>
</div>

@if ($selectedSiswa)
    <button type="button" onclick="window.print()"
        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white
                text-sm font-medium px-5 py-2.5 rounded-xl transition w-full mt-15 justify-center">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1
                    0 001-1v-4a1 1 0 00-1-1H9a1 1 0 00-1 1v4a1 1 0 001 1zm8-12V5a2 2 0 00-2-2H9a2
                    2 0 00-2 2v4h10z"/>
        </svg>
        Cetak / Print PDF
    </button>
@endif


@stack('scripts')
<script>
  function addRow(btn) {
    const addRowTr = btn.closest('tr');      // the row containing the clicked button
    const tbody = addRowTr.closest('tbody');  // its own tbody, not the whole page

    const newRow = document.createElement('tr');
    newRow.classList.add('data-row');
    newRow.innerHTML = `
      <td class="text-center px-4 py-3 text-sm text-gray-700"></td>
      <td class="px-4 py-3 text-sm text-gray-700"><input type="text" name="ekstrakulikuler[]" class="w-full" /></td>
      <td colspan="2">
        <div class="flex gap-2">
          <input type="text" name="keterangan[]" class="w-full text-sm text-gray-700" />
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
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #raporPrintArea, #raporPrintArea * {
            visibility: visible;
        }

        #raporPrintArea {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            margin: 0;
            border: none;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Hide the "add row" button row specifically */
        #raporPrintArea tr.add-row-tr {
            display: none !important;
        }

        .no-print {
            display: none !important;
        }

        textarea, input[type="text"] {
            border: none !important;
            background: transparent !important;
            resize: none;
            padding: 0 !important;
        }

        @page {
            size: A3;
            margin: none;
            scale: 74;
        }
    }
</style>
@endif

@endsection
