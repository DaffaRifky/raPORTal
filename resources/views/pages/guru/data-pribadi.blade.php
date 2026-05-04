@vite(['resources/css/app.css'])

<body class="bg-[#E8F1FE] p-6 ml-64">
    <x-sidebar-guru />
    <div class="container py-4 px-8 bg-white border border-black/30 rounded-2xl shadow-md">
        <p class="text-2xl mb-4">Data Pribadi</p>
        <hr class="mb-6 opacity-30 border">
        <div class="flex gap-6 mb-6">
            <div class="flex-none">
                <div class="bg-white w-60 h-84 border border-black/30 rounded-xl shadow-md">
                </div>
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="nip" class="block text-sm font-medium mb-1">NIP</label>
                        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="nip" name="nip" value="1234567890">
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="nama" name="nama" value="John Doe" >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="email" id="email" name="email" value="">
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-medium mb-1">No.HP</label>
                        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="HP" name="HP" value="081234567890">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Perguruan Tinggi</label>
                        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="perguruan" name="perguruan" value="">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Pendidikan terakhir</label>
                        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="pendidikan" name="pendidikan" value="">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Status Ikatan Kerja</label>
                        <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="status" name="status" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 flex justify-end">
            <a class="w-full text-center bg-[#F3F3F5] hover:bg-[#0A95FF] hover:text-white hover:border-[#0A95FF] border border-2 border-black/30 p-2 rounded-2xl" href="dashboard">Simpan Perubahan</a>
        </div>
    </div>
</body>
