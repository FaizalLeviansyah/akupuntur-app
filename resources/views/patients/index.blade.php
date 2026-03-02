@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 animate-fade-in-up">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">
                Direktori <span class="text-blue-600">Pasien</span>
            </h1>
            <p class="text-slate-500 text-xs sm:text-sm font-medium mt-1">
                Kelola data demografi dan rekam medis klinik.
            </p>
        </div>
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <form action="{{ route('patients.index') }}" method="GET" class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 shadow-sm transition-all" placeholder="Cari nama / No. Reg...">
            </form>

            <a href="{{ route('patients.create') }}" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-5 py-3 rounded-xl text-sm font-bold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transition-all flex items-center justify-center gap-2 transform hover:-translate-y-0.5 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Pasien Baru
            </a>
        </div>
    </div>

    {{-- Data Table Mobile Friendly --}}
    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-sm text-left text-slate-600 min-w-[800px]">
                <thead class="text-[11px] text-slate-500 uppercase tracking-widest bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 font-black">Profil Pasien</th>
                        <th class="px-6 py-4 font-black text-center">Usia</th>
                        <th class="px-6 py-4 font-black text-center">Gender</th>
                        <th class="px-6 py-4 font-black text-center">Aksi Medis</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($patients as $patient)
                    <tr class="hover:bg-blue-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center text-blue-600 font-black text-lg shrink-0 border border-blue-100/50 shadow-sm">
                                    {{ substr($patient->name, 0, 1) }}
                                </div>
                                <div>
                                    <a href="{{ route('patients.show', $patient->id) }}" class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors block text-base">
                                        {{ $patient->name }}
                                    </a>
                                    <div class="text-[10px] font-mono text-slate-400 font-bold uppercase mt-0.5 bg-slate-50 inline-block px-2 py-0.5 rounded">{{ $patient->registration_number }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="bg-slate-50 border border-slate-100 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-bold">{{ $patient->age }} Thn</span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest border {{ $patient->gender == 'L' ? 'bg-cyan-50 text-cyan-600 border-cyan-100' : 'bg-pink-50 text-pink-600 border-pink-100' }}">
                                {{ $patient->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('medical-records.create', $patient->id) }}" class="flex items-center gap-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white px-4 py-2 rounded-xl text-xs font-bold transition-all border border-emerald-100 hover:shadow-lg hover:shadow-emerald-500/30" title="Isi Rekam Medis">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Terapi Baru
                                </a>

                                <a href="{{ route('patients.edit', $patient->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 border border-transparent hover:border-blue-100 rounded-xl transition-colors" title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <form id="delete-form-{{ $patient->id }}" action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $patient->id }}')" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 rounded-xl transition-colors" title="Hapus Pasien">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-300 mb-4 border border-slate-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-slate-500 text-sm font-bold">Data pasien tidak ditemukan.</p>
                            <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci lain.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($patients->hasPages())
        <div class="p-4 sm:p-5 border-t border-slate-100 bg-slate-50/50">
            {{ $patients->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
