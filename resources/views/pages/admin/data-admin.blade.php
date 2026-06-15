@extends('pages.layout.layout')

@section('title', 'Data Admin TU')
@section('header', 'Data Admin TU')

@section('content')
        <div class="grid grid-cols-5 gap-4 mb-6">
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 col-span-4" type="text" placeholder="Masukan Nama atau NIP">
            <a href="" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-center">Tambah Admin TU +</a>
        </div>
        <div class="border border-gray-200 rounded-2xl overflow-hidden mb-4">
            <table class="table-auto w-full">
                <thead class="bg-indigo-50 text-indigo-700 font-medium">
                    <tr>
                        <th class="text-start px-4 py-3 font-semibold">NIP</th>
                        <th class="text-start px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="" class="divide-y divide-black/10">
                    @foreach ($nama as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $NIP[$index] }}</td>
                        <td class="px-4 py-3">{{ $item }}</td>
                        <td class="px-4 py-3 text-center">
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


@endsection
