@vite(['resources/css/app.css'])
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<body class="bg-[#E8F1FE] ml-64 p-4">
    <x-sidebar-admin />
    <div class="container py-4 px-8 bg-white border border-black/30 rounded-2xl shadow-md">
        <p class="text-2xl mb-4">Data Admin</p>
        <hr class="mb-4 opacity-30 border">
        <div class="grid grid-cols-5 gap-4 mb-6">
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 col-span-4" type="text" placeholder="Masukan Nama atau NIP">
            <a href="" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-center">Tambah Admin +</a>
        </div>
        <div class="border border-black/30 rounded-2xl overflow-hidden mb-4">
            <table class="table-auto w-full">
                <thead class="bg-[#D9D9D9]">
                    <tr>
                        <th class="text-start px-4 py-3 font-semibold">NIP</th>
                        <th class="text-start px-4 py-3 font-semibold">Nama Admin</th>
                        <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="" class="divide-y divide-black/10">
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>Andi Saputra, S.Pd</td>
                        <td class="px-4 py-3 text-center">
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>Budi Santoso, S.Pd</td>
                        <td class="px-4 py-3 text-center">
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>lyra anggraini, S.Pd</td>
                        <td class="px-4 py-3 text-center">
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>citra lestari, S.Pd</td>
                        <td class="px-4 py-3 text-center">
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>

                        </td>
                    </tr>
                    <tr>
                        <td>12345678-123456-1-123</td>
                        <td>irwan saputra, S.Pd</td>
                        <td class="px-4 py-3 text-center">
                            <button class="bg-amber-400 hover:bg-amber-500 text-white px-3 py-1 rounded-lg text-sm">Edit</button>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Detail</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm ml-1">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


