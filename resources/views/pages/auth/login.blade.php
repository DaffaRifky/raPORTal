<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<body class="bg-[#E8F1FE]">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <img src="{{ asset('img/logo.svg') }}" alt="logo" class="mx-auto mb-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if(
                    $errors->has('nama')
                )
                    <div class="text-red-600 text-sm mb-4 text-center">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <div class="mb-4">
                    @if($errors->has('role'))
                        <div class="text-red-600 text-sm mb-2 text-center">{{ $errors->first('role') }}</div>
                    @endif
                    <select id="role" name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Jenis User</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ old('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="wakel" {{ old('role') === 'wakel' ? 'selected' : '' }}>Wali Kelas</option>
                        <option value="kepsek" {{ old('role') === 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700"></label>
                    <input
                        id="nama"
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        required
                        autofocus
                        autocomplete="nama"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="NIP atau Nama"
                    >
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700"></label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Password"
                    >
                </div>
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 mx-auto"
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
