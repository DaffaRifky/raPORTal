@vite(['resources/css/app.css'])
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<body class="bg-[#E8F1FE] ml-64 p-4">
    <x-sidebar-admin />
    <div class="container py-4 px-8 bg-white border border-black/30 rounded-2xl shadow-md">
        <p class="text-2xl mb-4">Data Guru</p>
        <hr class="mb-4 opacity-30 border">
        <div class="grid grid-cols-5 gap-4 mb-6">
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 col-span-4" type="text" placeholder="Masukan Nama atau NIP">
            <a href="" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-center">Tambah Guru +</a>
        </div>
        <div class="border border-black/30 rounded-2xl overflow-hidden mb-4">
            <table class="table-auto w-full">
                <thead class="bg-[#D9D9D9]">
                    <tr>
                        <th class="text-start px-4 py-3 font-semibold">NIP</th>
                        <th class="text-start px-4 py-3 font-semibold">Nama Guru</th>
                        <th class="text-start px-4 py-3 font-semibold">Mata Pelajaran</th>
                        <th class="text-start px-4 py-3 font-semibold">Kelas Diampu</th>
                        <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="" class="divide-y divide-black/10">
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>Andi Saputra, S.Pd</td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">Matematika</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">Fisika</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">10-C</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">11-C</li>
                            </ul>
                        </td>
                        <td>
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>Budi Santoso, S.Pd</td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">BIN</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">BIG</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">10-A</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">10-B</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">11-B</li>
                            </ul>
                        </td>
                        <td>
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>lyra anggraini, S.Pd</td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">Kimia</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">Fisika</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">Biologi</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">12-C</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">12-D</li>
                            </ul>
                        </td>
                        <td>
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>citra lestari, S.Pd</td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">IPAS</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">10-A</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">11-A</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">11-C</li>
                            </ul>
                        </td>
                        <td>
                                                        <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>irwan saputra, S.Pd</td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">Matematika</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">Fisika</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="flex flex-row gap-2">
                                <li class="bg-white border border-black/30 rounded-xl px-4">10-C</li>
                                <li class="bg-white border border-black/30 rounded-xl px-4">11-C</li>
                            </ul>
                        </td>
                        <td>
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


