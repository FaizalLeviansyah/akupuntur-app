@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto pb-10">

    {{-- Header Navigation --}}
    <div class="flex items-center gap-4 mb-8 animate-fade-in-up">
        <a href="{{ route('patients.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Registrasi <span class="text-blue-600">Pasien Baru</span></h1>
            <p class="text-slate-500 text-xs font-medium mt-0.5">Lengkapi formulir demografi pasien di bawah ini.</p>
        </div>
    </div>

    {{-- Main Form Card --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="p-8 sm:p-10">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf

                {{-- Section 1: Identitas Utama --}}
                <div class="mb-8">
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-5 border-b border-slate-100 pb-3">
                        <div class="w-6 h-6 rounded-md bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        Informasi Dasar
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">No. Registrasi <span class="text-red-500">*</span></label>
                            <input type="text" name="registration_number" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors" placeholder="e.g. REG-001" required>
                            @error('registration_number') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap Pasien <span class="text-red-500">*</span></label>
                            <input type="text" name="name" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors" placeholder="Masukkan nama sesuai KTP" required>
                            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Usia <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" name="age" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 pr-12 transition-colors" placeholder="0" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 text-sm font-medium">Tahun</div>
                            </div>
                            @error('age') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors appearance-none cursor-pointer" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('gender') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('patients.index') }}" class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors text-center">
                        Batal
                    </a>
                    <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transform hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Data Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.4s ease-out forwards; }
</style>
@endsection
