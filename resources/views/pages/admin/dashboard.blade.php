<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<body class="bg-[#E8F1FE]">
    <x-sidebar-admin />
    <div class="ml-64 p-6">
        <div class="mb-6 p-4 bg-[#7BC5D4] py-10 rounded-lg shadow-md">
            <h1 class="text-4xl mb-2">Selamat datang di raPORTal</h1>
            <p>Anda login sebagai Admin</p>
        </div>
        <div class="mb-6 p-4 bg-[#E2E2E2] rounded-lg shadow-md border-2 border-black/30">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div class="container bg-white border border-black/30 rounded-xl p-4 ">
                    <p class="text-2xl">Jumlah Guru</p>
                    <p class="text-xl">35</p>
                </div>
                <div class="container bg-white border border-black/30 rounded-xl p-4 ">
                    <p class="text-2xl">Jumlah Kelas</p>
                    <p class="text-xl">14</p>
                </div>
                <div class="container bg-white border border-black/30 rounded-xl p-4 ">
                    <p class="text-2xl">Jumlah Siswa</p>
                    <p class="text-xl">453</p>
                </div>
                <div class="container bg-white border border-black/30 rounded-xl p-4 ">
                    <p class="text-2xl">Jumlah Admin</p>
                    <p class="text-xl">15</p>
                </div>
            </div>
            <div class="container bg-white border border-black/30 rounded-xl p-4 w-[50%] m-auto">
                    <p class="text-2xl">Kepala Sekolah</p>
                    <p class="text-xl">John Doe</p>
            </div>
        </div>
    </div>
</body>
