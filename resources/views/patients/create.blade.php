@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Input Data Pasien Baru</h2>
    <form action="#" method="POST">
        @csrf
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Nomor Registrasi</label>
                <input type="text" name="registration_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="REG-0001">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Usia</label>
                <input type="number" name="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                <select name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                    <option value="P">Gender Di Sembunyikan!</option>
                </select>
            </div>
        </div>

        <hr class="my-6">

        <h3 class="text-lg font-semibold mb-3">Pengamatan Lidah (Form 1)</h3>
        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <label class="block mb-2 text-sm font-medium">Warna Otot Lidah</label>
                <input type="text" name="tongue_color" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Bentuk Lidah</label>
                <input type="text" name="tongue_shape" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium">Selaput/Lumut</label>
                <input type="text" name="tongue_moss" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
            </div>
        </div>

        <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"> Simpan Data Pasien </button>
    </form>
</div>
@endsection
