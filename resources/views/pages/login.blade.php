@vite(['resources/css/app.css'])
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<body class="bg-[#E8F1FE]">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <img src="{{ asset('img/logo.svg') }}" alt="logo" class="mx-auto mb-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">NIP atau Nama</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="flex items-center justify-between">
                    <a href="guru/dashboard"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 mx-auto">
                        login
                    </a>

</body>
