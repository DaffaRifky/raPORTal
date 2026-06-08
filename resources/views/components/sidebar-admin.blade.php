@vite(['resources/css/app.css'])

<div class="fixed top-0 left-0 w-64 h-screen bg-[#2D5676] shadow-2xl flex flex-col">
    <div>
        <img class="p-4" src="{{ asset('img/logo.svg') }}" alt="logo" class="mx-auto mb-6">
        <hr class="opacity-25">
        <nav >
            <ul>
                <x-sidebarlink href="/admin/dashboard">Dashboard</x-sidebarlink>
                <x-sidebarlink href="/dataguru">Data Guru</x-sidebarlink>
                <x-sidebarlink href="/datakelas">Data Kelas</x-sidebarlink>
                <x-sidebarlink href="/datasiswa">Data Siswa</x-sidebarlink>
                <x-sidebarlink href="/admin/data-admin">Data Admin</x-sidebarlink>
            </ul>
        </nav>
    </div>
    <div class="mt-auto">
        <hr class="opacity-25">
            <ul class="mt-auto">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-white">Logout</button>
                    </form>
                </li>
            </ul>
    </div>
</div>
