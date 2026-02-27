@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto pb-12">

    <div class="flex items-center justify-between mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <a href="{{ route('patients.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Profil & <span class="text-blue-600">Riwayat Medis</span></h1>
            </div>
        </div>

        <a href="{{ route('medical-records.create', $patient->id) }}" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transform hover:-translate-y-0.5 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Sesi Terapi Baru
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="bg-gradient-to-r from-slate-50 to-blue-50/50 p-8 flex flex-col md:flex-row items-start md:items-center gap-6 border-b border-slate-100">
            <div class="w-20 h-20 rounded-2xl bg-white shadow-sm border border-blue-100 flex items-center justify-center text-blue-600 font-black text-3xl shrink-0">
                {{ substr($patient->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <h2 class="text-2xl font-black text-slate-800">{{ $patient->name }}</h2>
                <div class="flex flex-wrap gap-3 mt-3">
                    <span class="bg-white border border-slate-200 px-3 py-1 rounded-lg text-xs font-mono text-slate-600 font-bold tracking-widest">
                        {{ $patient->registration_number }}
                    </span>
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-xs font-bold">
                        {{ $patient->age }} Tahun
                    </span>
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-bold">
                        {{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </div>
            </div>
            <div class="w-full md:w-auto mt-4 md:mt-0 text-right">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Kunjungan</p>
                <p class="text-3xl font-black text-blue-600">{{ $patient->medicalRecords->count() }} <span class="text-sm text-slate-500">Sesi</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 sm:p-10 animate-fade-in-up" style="animation-delay: 0.2s;">
        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-8 border-b border-slate-100 pb-4">
            <div class="w-6 h-6 rounded-md bg-blue-100 text-blue-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            Timeline Terapi Pasien
        </h3>

        @if($patient->medicalRecords->isEmpty())
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-300 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <p class="text-slate-500 text-sm font-medium">Belum ada riwayat rekam medis.</p>
            </div>
        @else
            <ol class="relative border-s-2 border-slate-100 ml-3">
                @foreach($patient->medicalRecords as $record)
                <li class="mb-10 ms-8 group">
                    <span class="absolute flex items-center justify-center w-8 h-8 rounded-full -start-4 ring-8 ring-white transition-colors {{ $loop->first ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 text-slate-400 group-hover:bg-blue-100 group-hover:text-blue-500' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </span>

                    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-blue-100 transition-all">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 border-b border-slate-50 pb-4">
                            <div>
                                <h3 class="flex items-center text-lg font-black text-slate-800">
                                    {{ $record->created_at->translatedFormat('l, d F Y') }}
                                    @if($loop->first)
                                        <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded ml-3 uppercase tracking-widest">Terbaru</span>
                                    @endif
                                </h3>
                                <time class="block text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ $record->created_at->format('H:i') }} WIB</time>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('medical-records.show', [$patient->id, $record->id]) }}" class="inline-flex items-center px-4 py-2 text-xs font-bold text-slate-600 bg-slate-50 border border-slate-200 rounded-lg hover:bg-white hover:text-blue-600 transition-colors">
                                    Lihat Detail
                                </a>
                                <a href="{{ route('medical-records.pdf', [$patient->id, $record->id]) }}" class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors shadow-md shadow-red-500/20">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    PDF
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Keluhan Utama</p>
                                <p class="font-medium text-slate-700">{{ $record->keluhan_utama ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Diagnosis</p>
                                <p class="font-medium text-slate-700">{{ $record->diagnosis_penyakit ?? '-' }}</p>
                                <p class="text-xs text-slate-500">{{ $record->diagnosis_sindrom ?? '' }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Titik Terapi (Akupunktur)</p>
                                <p class="text-slate-600 bg-slate-50 p-3 rounded-xl text-xs">{{ $record->titik_akupuntur ?? 'Tidak ada titik yang dicatat.' }}</p>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ol>
        @endif
    </div>
</div>

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.4s ease-out forwards; }
</style>
@endsection
