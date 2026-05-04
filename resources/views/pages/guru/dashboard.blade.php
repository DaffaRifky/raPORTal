@vite(['resources/css/app.css'])

<body class="bg-[#E8F1FE]">
    <x-sidebar-guru />
    <div class="ml-64 p-6">
        <div class="mb-6 p-4 bg-[#7BC5D4] py-10 rounded-lg shadow-md">
            <h1 class="text-4xl mb-2">Selamat datang di raPORTal</h1>
            <p>Anda login sebagai guru</p>
        </div>
        <div class="mb-6 p-4 bg-[#E2E2E2] rounded-lg shadow-md border-2 border-black/30 flex gap-6 ">
            <div class="flex-none">
                <div class="bg-white w-60 h-80">
                </div>
            </div>
            <div class="flex-1">
                <p class="text-center">data diri</p>
                <hr class="opacity-30 border">
                <p>NIP: 12345678-123456-1-123</p>
                <p>Nama</p>
                <p>No.HP</p>
                <p>Email</p>
                <p>Perguruan tinggi</p>
                <p>Pendidikan terakhir</p>
                <p>Status ikatan kerja</p>
            </div>
        </div>
        <div class="mb-6 p-4 bg-[#E2E2E2] rounded-lg shadow-md border-2 border-black/30">
            <div class="flex gap-6 mb-4">
                <div class="container bg-white border border-black/30 rounded-xl p-4 flex-1">
                    <p class="text-2xl">Kelas Diampu</p>
                    <p class="text-xl">6</p>
                </div>
                <div class="container bg-white border border-black/30 rounded-xl p-4 flex-1">
                    <p class="text-2xl">Jumlah Siswa</p>
                    <p class="text-xl">193</p>
                </div>
            </div>
            <p>Mata Pelajaran Diampu:</p>
            <ul class="flex flex-row gap-2">
                <li class="bg-white border border-black/30 rounded-xl px-4">Matematika</li>
                <li class="bg-white border border-black/30 rounded-xl px-4">Fisika</li>
            </ul>
        </div>
    </div>
</body>
