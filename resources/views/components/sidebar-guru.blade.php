@vite(['resources/css/app.css'])

<div class="fixed top-0 left-0 w-64 h-screen bg-[#2D5676] shadow-2xl flex flex-col">
    <div>
        <img class="p-4" src="{{ asset('img/logo.svg') }}" alt="logo" class="mx-auto mb-6">
        <hr class="opacity-25">
        <nav >
            <ul>
                <x-sidebarlink href="/guru/dashboard">Dashboard</x-sidebarlink>
                <x-sidebarlink href="/guru/input-nilai">Input Nilai</x-sidebarlink>
                <x-sidebarlink href="/guru/data-pribadi">Data Pribadi</x-sidebarlink>
            </ul>
        </nav>
    </div>
    <div class="mt-auto">
        <hr class="opacity-25">
            <ul class="mt-auto">
                <x-sidebarlink href="/login">Logout</x-sidebarlink>
            </ul>
    </div>
</div>
