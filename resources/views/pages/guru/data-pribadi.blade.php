@extends('pages.layout.layout')

@section('title', 'Data Pribadi')
@section('header', 'Data Pribadi')

@section('content')
<form action="">
            <div class="flex mb-6">
                <div class="flex-none bg-[#617a9e] p-4 rounded-tl-xl rounded-bl-xl shadow-md ">
                    <p class="text-white mb-2 text-center text-lg">Pilih Foto Profil</p>
                    <a href="" class="bg-white w-60 h-84 border border-black/30 rounded-xl shadow-md m-6 mt-0 text-lg text-gray-500 text-center flex items-center justify-center"></a>
                </div>

                <div class="flex-1 p-6 bg-[#e2e2e2] rounded-tr-lg rounded-br-lg shadow-md">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="nip" class="block text-sm font-medium mb-1">NIP</label>
                            <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="nip" name="nip" value="1234567890">
                        </div>
                        <div>
                            <label for="nama" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300  rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="nama" name="nama" value="John Doe" >
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">Email</label>
                            <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="email" id="email" name="email" value="">
                        </div>
                        <div>
                            <label for="nama" class="block text-sm font-medium mb-1">No.HP</label>
                            <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="HP" name="HP" value="081234567890">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">Perguruan Tinggi</label>
                            <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="perguruan" name="perguruan" value="">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-1">Pendidikan terakhir</label>
                            <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="pendidikan" name="pendidikan" value="">
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block text-sm font-medium mb-1">Alamat</label>
                            <input class="w-full px-3 py-2 border-2 bg-gray-50 border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" id="alamat" name="alamat" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 flex justify-end">
                <a class="w-full text-center bg-[#0A95FF] text-white p-2 rounded-2xl" href="/dashboard">Simpan Perubahan</a>
            </div>
</form>
@endsection
