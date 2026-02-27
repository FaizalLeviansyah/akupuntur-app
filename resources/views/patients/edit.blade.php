@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Pasien</h2>
        <a href="{{ route('patients.index') }}" class="text-sm text-blue-600 hover:underline">Kembali ke Daftar</a>
    </div>

    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid gap-6 mb-6">
            <div>
                <label for="registration_number" class="block mb-2 text-sm font-medium text-gray-900">Nomor Registrasi</label>
                <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number', $patient->registration_number) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('registration_number')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="age" class="block mb-2 text-sm font-medium text-gray-900">Usia</label>
                    <input type="number" name="age" id="age" value="{{ old('age', $patient->age) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="L" {{ $patient->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $patient->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                Perbarui Data Pasien
            </button>
            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pasien ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all">
                    Hapus Pasien
                </button>
            </form>
        </div>
    </form>
</div>
@endsection
