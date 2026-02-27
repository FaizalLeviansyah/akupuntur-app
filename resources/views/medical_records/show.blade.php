@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mb-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 print:hidden gap-4">
        <a href="{{ route('patients.index') }}" class="text-slate-500 hover:text-blue-600 font-bold text-sm flex items-center gap-2 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Direktori
        </a>

        <div class="flex gap-3 w-full sm:w-auto">
            <button onclick="window.print()" class="w-full sm:w-auto bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold rounded-xl text-sm px-5 py-2.5 flex items-center justify-center gap-2 shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Printer
            </button>

            <a href="{{ route('medical-records.pdf', [$patient->id, $record->id]) }}" class="w-full sm:w-auto bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 font-bold rounded-xl text-sm px-5 py-2.5 flex items-center justify-center gap-2 shadow-lg shadow-red-500/30 transition-transform transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Unduh PDF
            </a>
        </div>
    </div>

    <div class="bg-white p-8 sm:p-12 rounded-lg shadow-lg print:shadow-none print:p-0">

        <div class="border-b-4 border-gray-800 pb-4 mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold uppercase tracking-wider text-gray-900">LKP Mandiri</h1>
                <p class="text-sm text-gray-600">Lembaga Kursus dan Pelatihan Akupunktur & Penyehat Tradisional</p>
                <p class="text-xs text-gray-500">Jl. S Parman III / 18, Malang | Telp: (0341) 478292</p>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold text-gray-800">REKAM MEDIS</h2>
                <p class="text-sm text-gray-600">Tanggal: {{ $record->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <table class="w-full">
                    <tr><td class="w-32 py-1 text-gray-500 font-medium">No. Registrasi</td><td class="font-bold">: {{ $patient->registration_number }}</td></tr>
                    <tr><td class="py-1 text-gray-500 font-medium">Nama Pasien</td><td class="font-bold">: {{ $patient->name }}</td></tr>
                </table>
            </div>
            <div>
                <table class="w-full">
                    <tr><td class="w-32 py-1 text-gray-500 font-medium">Usia / Gender</td><td class="font-bold">: {{ $patient->age }} Tahun / {{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                    <tr><td class="py-1 text-gray-500 font-medium">Pekerjaan</td><td class="font-bold">: {{ $patient->job ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-300 mb-2 uppercase text-sm bg-gray-50 p-1">I. Wawancara (Anamnesis)</h3>
            <table class="w-full text-sm">
                <tr><td class="w-40 py-1 align-top text-gray-600">Keluhan Utama</td><td class="py-1">: {{ $record->keluhan_utama ?? '-' }}</td></tr>
                <tr><td class="py-1 align-top text-gray-600">Keluhan Tambahan</td><td class="py-1">: {{ $record->keluhan_tambahan ?? '-' }}</td></tr>
                <tr><td class="py-1 align-top text-gray-600">Riwayat Penyakit</td><td class="py-1">: {{ $record->riwayat_penyakit_sekarang ?? '-' }}</td></tr>
            </table>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-300 mb-2 uppercase text-sm bg-gray-50 p-1">II. Pengamatan (Fisik & Lidah)</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <table class="w-full">
                    <tr><td class="w-32 py-1 text-gray-600">Kesadaran (Shen)</td><td>: {{ $record->shen_kesadaran ?? '-' }}</td></tr>
                    <tr><td class="py-1 text-gray-600">Warna Wajah</td><td>: {{ $record->warna_wajah ?? '-' }}</td></tr>
                </table>
                <table class="w-full">
                    <tr><td class="w-32 py-1 text-gray-600">Warna Lidah</td><td>: {{ $record->lidah_warna ?? '-' }}</td></tr>
                    <tr><td class="py-1 text-gray-600">Bentuk Lidah</td><td>: {{ $record->lidah_bentuk ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-300 mb-2 uppercase text-sm bg-gray-50 p-1">III. Perabaan (Nadi & Titik Meridian)</h3>

            @php
                // Decode JSON Nadi jika ada
                $nadiKanan = json_decode($record->nadi_kanan, true) ?? [];
                $nadiKiri = json_decode($record->nadi_kiri, true) ?? [];
            @endphp

            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                <div class="border p-2 rounded">
                    <p class="font-bold text-center mb-1 border-b">Tangan Kanan</p>
                    <p><span class="text-gray-500 inline-block w-12">Cun:</span> {{ $nadiKanan['cun'] ?? '-' }}</p>
                    <p><span class="text-gray-500 inline-block w-12">Guan:</span> {{ $nadiKanan['guan'] ?? '-' }}</p>
                    <p><span class="text-gray-500 inline-block w-12">Chi:</span> {{ $nadiKanan['chi'] ?? '-' }}</p>
                </div>
                <div class="border p-2 rounded">
                    <p class="font-bold text-center mb-1 border-b">Tangan Kiri</p>
                    <p><span class="text-gray-500 inline-block w-12">Cun:</span> {{ $nadiKiri['cun'] ?? '-' }}</p>
                    <p><span class="text-gray-500 inline-block w-12">Guan:</span> {{ $nadiKiri['guan'] ?? '-' }}</p>
                    <p><span class="text-gray-500 inline-block w-12">Chi:</span> {{ $nadiKiri['chi'] ?? '-' }}</p>
                </div>
            </div>

            @if($record->pointChecks && $record->pointChecks->count() > 0)
            <table class="w-full text-sm border-collapse border border-gray-300 mt-2">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-1 text-left">Meridian Abnomal</th>
                        <th class="border border-gray-300 p-1 text-center w-24">Yen (Sumber)</th>
                        <th class="border border-gray-300 p-1 text-center w-24">Su (Belakang)</th>
                        <th class="border border-gray-300 p-1 text-center w-24">Mu (Depan)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($record->pointChecks as $point)
                    <tr>
                        <td class="border border-gray-300 p-1">{{ $point->meridian_name }}</td>
                        <td class="border border-gray-300 p-1 text-center font-bold text-gray-800">{{ $point->yen_point ? '✓' : '-' }}</td>
                        <td class="border border-gray-300 p-1 text-center font-bold text-gray-800">{{ $point->su_point ? '✓' : '-' }}</td>
                        <td class="border border-gray-300 p-1 text-center font-bold text-gray-800">{{ $point->mu_point ? '✓' : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-sm text-gray-500 italic">Data pemeriksaan titik (Yen/Mu/Su) tidak dicatat pada sesi ini.</p>
            @endif
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-300 mb-2 uppercase text-sm bg-gray-50 p-1">IV. Diagnosis & Terapi</h3>
            <table class="w-full text-sm">
                <tr><td class="w-40 py-1 align-top text-gray-600">Diagnosis Penyakit</td><td class="py-1 font-medium">: {{ $record->diagnosis_penyakit ?? '-' }}</td></tr>
                <tr><td class="py-1 align-top text-gray-600">Diagnosis Sindrom</td><td class="py-1 font-medium">: {{ $record->diagnosis_sindrom ?? '-' }}</td></tr>
                <tr><td class="py-1 align-top text-gray-600">Titik Akupuntur</td><td class="py-1">: {{ $record->titik_akupuntur ?? '-' }}</td></tr>
                <tr><td class="py-1 align-top text-gray-600">Anjuran & Saran</td><td class="py-1">: {{ $record->saran_anjuran ?? '-' }}</td></tr>
            </table>
        </div>

        <div class="mt-12 flex justify-end">
            <div class="text-center">
                <p class="text-sm text-gray-600 mb-16">Praktisi / Akupunkturis</p>
                <p class="text-sm font-bold border-b border-gray-800 px-4">( .......................................... )</p>
            </div>
        </div>

    </div>
</div>

<style>
    @media print {
        body { background-color: white !important; }
        nav { display: none !important; }
        main { padding-top: 0 !important; margin: 0 !important; }
    }
</style>
@endsection
