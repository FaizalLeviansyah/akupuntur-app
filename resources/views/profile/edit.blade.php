@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto pb-12">

    <div class="flex items-center justify-between mb-8 animate-fade-in-up">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Pengaturan <span class="text-blue-600">Akun</span></h1>
            <p class="text-slate-500 text-xs font-medium mt-1">Kelola profil pribadi dan keamanan password Anda.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Sidebar Mini Profil --}}
        <div class="md:col-span-1 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-blue-500 to-cyan-400"></div>
                <div class="relative mt-8">
                    <img class="w-24 h-24 rounded-full border-4 border-white shadow-lg mx-auto mb-4" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0ea5e9&color=fff&size=128" alt="Profile">
                    <h3 class="text-lg font-black text-slate-800">{{ $user->name }}</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">{{ str_replace('_', ' ', $user->role) }}</p>
                </div>
            </div>
        </div>

        {{-- Form Edit Profil & Password --}}
        <div class="md:col-span-2 space-y-8 animate-fade-in-up" style="animation-delay: 0.2s;">

            {{-- Update Profile Info --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 sm:p-10">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-6 border-b border-slate-100 pb-3">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Informasi Profil
                </h3>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3" required autofocus autocomplete="name">
                        <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3" required autocomplete="username">
                        <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('email')" />
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="bg-slate-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:bg-slate-700 transition-all">Simpan Profil</button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-emerald-600">Tersimpan.</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Update Password --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 sm:p-10">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-6 border-b border-slate-100 pb-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Ubah Kata Sandi
                </h3>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Password Saat Ini</label>
                        <input type="password" name="current_password" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3" autocomplete="current-password">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-500" />
                    </div>

                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Password Baru</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3" autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-500" />
                    </div>

                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3" autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transform hover:-translate-y-0.5 transition-all">Perbarui Password</button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-emerald-600">Password Diperbarui.</p>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.4s ease-out forwards; }
</style>
@endsection
