@vite(['resources/css/app.css'])
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="fixed top-0 left-0 w-64 h-screen bg-[#2D5676] shadow-2xl flex flex-col">
    <div>
        <img class="p-4" src="{{ asset('img/logo.svg') }}" alt="logo" class="mx-auto mb-6">
        <hr class="opacity-25">
        <nav >
            <ul>
                <li class="py-3 bg-[#2D5676] hover:bg-[#1B394F]">
                    <a href="#" class="text-white hover:text-blue-500 px-4">Dashboard</a>
                </li>
                <li class="py-3 bg-[#2D5676] hover:bg-[#1B394F]">
                    <a href="#" class="text-white hover:text-blue-500 px-4">Profile</a>
                </li>
                <li class="py-3 bg-[#2D5676] hover:bg-[#1B394F]">
                    <a href="#" class="text-white hover:text-blue-500 px-4">Settings</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="mt-auto">
        <hr class="opacity-25">
            <ul class="mt-auto">
                <li class="py-3 ">
                    <a href="#" class="text-white px-4 hover:text-blue-500 bg-[#2D5676] hover:bg-[#1B394F] py-3 pr-47 ">Logout</a>
                </li>
            </ul>
    </div>
</div>
