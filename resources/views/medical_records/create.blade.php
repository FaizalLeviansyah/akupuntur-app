@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Rekam Medis: {{ $patient->name }}</h2>
        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $patient->registration_number }}</span>
    </div>

    <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="medicalTab" data-tabs-toggle="#medicalTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="anamnesis-tab" data-tabs-target="#anamnesis" type="button" role="tab">I. Anamnesis</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="fisik-tab" data-tabs-target="#fisik" type="button" role="tab">II. Pemeriksaan Fisik</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="nadi-tab" data-tabs-target="#nadi" type="button" role="tab">III. Nadi & Titik (Form 2)</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="diagnosis-tab" data-tabs-target="#diagnosis" type="button" role="tab">IV. Diagnosis & Terapi</button>
            </li>
        </ul>
    </div>

    <form action="{{ route('medical-records.store', $patient->id) }}" method="POST">
        @csrf
        <div id="medicalTabContent">

            <div class="hidden p-4 rounded-lg bg-gray-50" id="anamnesis" role="tabpanel">
                <div class="grid gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Keluhan Utama</label>
                        <textarea name="keluhan_utama" rows="3" class="block w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Apa yang dirasakan pasien saat ini?"></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Keluhan Tambahan</label>
                        <textarea name="keluhan_tambahan" rows="3" class="block w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Riwayat Penyakit Sekarang</label>
                            <textarea name="riwayat_penyakit_sekarang" rows="2" class="block w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300"></textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Riwayat Penyakit Dahulu</label>
                            <textarea name="riwayat_penyakit_dahulu" rows="2" class="block w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50" id="fisik" role="tabpanel">
                <h3 class="mb-4 text-lg font-bold text-gray-700">Pengamatan Lidah (Inspeksi)</h3>
                <div class="grid gap-4 sm:grid-cols-3 mb-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Warna Otot Lidah</label>
                        <input type="text" name="lidah_warna" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Bentuk Lidah</label>
                        <input type="text" name="lidah_bentuk" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Selaput/Lumut Lidah</label>
                        <input type="text" name="lidah_selaput" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>

                <h3 class="mb-4 text-lg font-bold text-gray-700">Keadaan Jiwa & Wajah</h3>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Kesadaran (Shen)</label>
                        <input type="text" name="shen_kesadaran" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Warna Wajah</label>
                        <input type="text" name="warna_wajah" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50" id="nadi" role="tabpanel">
                <h3 class="mb-4 text-lg font-bold text-gray-700">Pemeriksaan Nadi (Cun, Guan, Chi)</h3>
                <div class="grid gap-4 sm:grid-cols-2 mb-8">
                    <div class="p-4 border rounded-lg bg-white shadow-sm">
                        <p class="font-bold border-b pb-2 mb-4 text-blue-600">Tangan Kanan</p>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold uppercase text-gray-500">Cun (Paru-Paru / LU)</label>
                                <input type="text" name="nadi_kanan[cun]" class="w-full p-2 text-sm border rounded focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="text-xs font-semibold uppercase text-gray-500">Guan (Limpa / SP)</label>
                                <input type="text" name="nadi_kanan[guan]" class="w-full p-2 text-sm border rounded focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="text-xs font-semibold uppercase text-gray-500">Chi (Ming Men / MM)</label>
                                <input type="text" name="nadi_kanan[chi]" class="w-full p-2 text-sm border rounded focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border rounded-lg bg-white shadow-sm">
                        <p class="font-bold border-b pb-2 mb-4 text-red-600">Tangan Kiri</p>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold uppercase text-gray-500">Cun (Jantung / HT)</label>
                                <input type="text" name="nadi_kiri[cun]" class="w-full p-2 text-sm border rounded focus:ring-red-500">
                            </div>
                            <div>
                                <label class="text-xs font-semibold uppercase text-gray-500">Guan (Hati / LR)</label>
                                <input type="text" name="nadi_kiri[guan]" class="w-full p-2 text-sm border rounded focus:ring-red-500">
                            </div>
                            <div>
                                <label class="text-xs font-semibold uppercase text-gray-500">Chi (Ginjal / KI)</label>
                                <input type="text" name="nadi_kiri[chi]" class="w-full p-2 text-sm border rounded focus:ring-red-500">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="mb-4 text-lg font-bold text-gray-700">Pemeriksaan Titik Yen-Mu-Su</h3>
                <div class="relative overflow-x-auto shadow-sm sm:rounded-lg border">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-r">Nama Meridian</th>
                                <th class="px-6 py-3 text-center border-r">Yen (Sumber)</th>
                                <th class="px-6 py-3 text-center border-r">Su (Belakang)</th>
                                <th class="px-6 py-3 text-center">Mu (Depan)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $meridians = [
                                    'LU' => 'Paru-Paru', 'LI' => 'Usus Besar', 'ST' => 'Lambung',
                                    'SP' => 'Limpa', 'HT' => 'Jantung', 'SI' => 'Usus Kecil',
                                    'BL' => 'Kandung Kemih', 'KI' => 'Ginjal', 'PC' => 'Selaput Jantung',
                                    'TE' => 'Tri Pemanas', 'GB' => 'Kandung Empedu', 'LR' => 'Hati'
                                ];
                            @endphp
                            @foreach($meridians as $code => $name)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-3 font-medium text-gray-900 border-r">{{ $name }} ({{ $code }})</td>
                                <td class="px-6 py-3 text-center border-r">
                                    <input type="checkbox" name="points[{{ $code }}][yen]" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                    <input type="hidden" name="points[{{ $code }}][meridian]" value="{{ $name }}">
                                </td>
                                <td class="px-6 py-3 text-center border-r">
                                    <input type="checkbox" name="points[{{ $code }}][su]" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <input type="checkbox" name="points[{{ $code }}][mu]" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50" id="diagnosis" role="tabpanel">
                <div class="grid gap-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Diagnosis Penyakit</label>
                            <input type="text" name="diagnosis_penyakit" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Diagnosis Sindrom</label>
                            <input type="text" name="diagnosis_sindrom" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Pemilihan Titik Akupuntur</label>
                        <textarea name="titik_akupuntur" rows="4" class="block w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Sebutkan titik-titik yang akan ditusuk..."></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Anjuran & Saran</label>
                        <textarea name="saran_anjuran" rows="2" class="block w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300"></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-10 py-3 text-center shadow-lg transition-all">
                        Simpan Rekam Medis Lengkap
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabElements = [
            { id: 'anamnesis', triggerEl: document.querySelector('#anamnesis-tab'), targetEl: document.querySelector('#anamnesis') },
            { id: 'fisik', triggerEl: document.querySelector('#fisik-tab'), targetEl: document.querySelector('#fisik') },
            { id: 'nadi', triggerEl: document.querySelector('#nadi-tab'), targetEl: document.querySelector('#nadi') },
            { id: 'diagnosis', triggerEl: document.querySelector('#diagnosis-tab'), targetEl: document.querySelector('#diagnosis') }
        ];
    });
</script>
@endsection
