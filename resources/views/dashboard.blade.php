@extends('layouts.app')

@section('content')

@php
    $totalPasien = \App\Models\Patient::count();
    $totalRekam = \App\Models\MedicalRecord::count();
    $pasienBaru = \App\Models\Patient::whereMonth('created_at', date('m'))->count();
    $recentRecords = \App\Models\MedicalRecord::with('patient')->latest()->take(5)->get();
@endphp

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="max-w-7xl mx-auto pb-20">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 animate-fade-in-up">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                Dashboard <span class="text-blue-600">Klinik</span>
            </h1>
            <p class="text-slate-500 text-xs font-medium mt-1">
                Selamat datang kembali, <span class="text-blue-600 font-bold">{{ Auth::user()->name }}</span>! 👋
            </p>
        </div>
        <div class="hidden md:block">
            <div class="bg-white/80 backdrop-blur-sm border border-slate-200 px-4 py-2 rounded-xl text-xs font-bold text-slate-600 shadow-sm flex items-center gap-2">
                <div class="relative flex h-2.5 w-2.5">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </div>
                <span>Sistem Online</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-center group hover:shadow-lg hover:-translate-y-1 transition-all relative overflow-hidden">
            <div class="absolute right-0 top-0 h-full w-1.5 bg-blue-500"></div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pasien Terdaftar</p>
                <h3 class="text-3xl font-black text-slate-800">{{ $totalPasien }}</h3>
                <p class="text-[10px] text-blue-500 font-bold mt-1 bg-blue-50 px-2 py-0.5 rounded w-fit">Basis Data Master</p>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-center group hover:shadow-lg hover:-translate-y-1 transition-all relative overflow-hidden">
            <div class="absolute right-0 top-0 h-full w-1.5 bg-emerald-500"></div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pasien Baru Bulan Ini</p>
                <h3 class="text-3xl font-black text-slate-800">{{ $pasienBaru }}</h3>
                <p class="text-[10px] text-emerald-500 font-bold mt-1 bg-emerald-50 px-2 py-0.5 rounded w-fit">Pendaftaran Aktif</p>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
        </div>

        <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-6 rounded-3xl shadow-lg text-white relative overflow-hidden flex justify-between items-center group hover:shadow-xl hover:-translate-y-1 transition-all">
            <div class="absolute right-0 top-0 w-32 h-32 bg-cyan-400/20 blur-2xl rounded-full -mr-10 -mt-10"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest mb-1">Total Rekam Medis (Sesi)</p>
                <h3 class="text-3xl font-black text-white">{{ $totalRekam }}</h3>
                <p class="text-[10px] text-cyan-300 font-bold mt-1 bg-cyan-900/50 px-2 py-0.5 rounded w-fit">Riwayat Terapi</p>
            </div>
            <div class="w-12 h-12 bg-slate-700/50 text-cyan-400 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-slate-600 relative z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up" style="animation-delay: 0.2s;">

        <div class="lg:col-span-2 bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="font-black text-lg text-slate-800">Statistik Kunjungan</h3>
                    <p class="text-xs font-medium text-slate-400 mt-1">Grafik aktivitas rekam medis 6 bulan terakhir</p>
                </div>
            </div>
            <div id="chart-visits" class="w-full h-64"></div>
        </div>

        <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden flex flex-col h-full">
            <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                <div>
                    <h3 class="font-black text-sm text-slate-800">Aktivitas Terapi Terbaru</h3>
                    <p class="text-[10px] font-bold text-slate-400 mt-0.5">5 Pasien terakhir ditangani</p>
                </div>
            </div>
            <div class="p-6 flex-1">
                <div class="space-y-6">
                    @forelse($recentRecords as $record)
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0 border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            {{ substr($record->patient->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('patients.show', $record->patient->id) }}" class="text-sm font-bold text-slate-800 hover:text-blue-600 transition-colors truncate block">
                                {{ $record->patient->name }}
                            </a>
                            <p class="text-[10px] text-slate-500 font-medium truncate mt-0.5">Keluhan: {{ $record->keluhan_utama ?? 'Tidak ada catatan' }}</p>
                            <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ $record->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            <a href="{{ route('medical-records.show', [$record->patient->id, $record->id]) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors block border border-transparent hover:border-blue-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10">
                        <p class="text-xs text-slate-400 font-medium">Belum ada aktivitas rekam medis.</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="p-4 border-t border-slate-50 bg-slate-50/50 text-center">
                <a href="{{ route('patients.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors uppercase tracking-widest">Lihat Semua Pasien &rarr;</a>
            </div>
        </div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var optionsVisits = {
            series: [{
                name: 'Kunjungan Medis',
                data: [15, 22, 18, 35, 28, 42]
            }],
            chart: {
                height: 250,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif',
                sparkline: { enabled: false }
            },
            colors: ['#0ea5e9'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                labels: { style: { colors: '#94a3b8', fontSize: '11px', fontWeight: 600 } },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: { style: { colors: '#94a3b8', fontSize: '11px', fontWeight: 600 } }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
                yaxis: { lines: { show: true } }
            },
            tooltip: { theme: 'light' }
        };

        var chartVisits = new ApexCharts(document.querySelector("#chart-visits"), optionsVisits);
        chartVisits.render();
    });
</script>

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
</style>

@endsection
