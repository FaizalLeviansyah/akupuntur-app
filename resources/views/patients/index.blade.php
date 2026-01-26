@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form action="{{ route('patients.index') }}" method="GET" class="flex items-center">
                    <label for="simple-search" class="sr-only">Cari</label>
                    <div class="relative w-full">
                        <input type="text" name="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" placeholder="Cari nama atau nomor registrasi...">
                    </div>
                </form>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <a href="{{ route('patients.create') }}" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
                    Tambah Pasien
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-3">No. Registrasi</th>
                        <th class="px-4 py-3">Nama Pasien</th>
                        <th class="px-4 py-3">Usia</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr class="border-b">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->registration_number }}</td>
                        <td class="px-4 py-3">{{ $patient->name }}</td>
                        <td class="px-4 py-3">{{ $patient->age }}</td>
                        <td class="px-4 py-3">{{ $patient->gender }}</td>
                        <td class="px-6 py-4 flex gap-3">
                            {{-- Perhatikan penggunaan $patient di bawah ini --}}
                            <a href="{{ route('medical-records.create', $patient->id) }}" class="font-medium text-blue-600 hover:underline">Rekam Medis</a>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="font-medium text-gray-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $patients->links() }}
        </div>
    </div>
</div>
@endsection
