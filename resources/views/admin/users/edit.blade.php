@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto pb-10">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.users.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Edit <span class="text-blue-600">Pengguna</span></h1>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3" required>
                </div>
                <div>
                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Email (Login)</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3" required>
                </div>
                <div>
                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Hak Akses</label>
                    <select name="role" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3" required>
                        <option value="praktisi" {{ $user->role == 'praktisi' ? 'selected' : '' }}>Praktisi (Dokter/Terapis)</option>
                        <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin (IT/Pusat)</option>
                    </select>
                </div>
                <div class="md:col-span-2 pt-4 border-t border-slate-100">
                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Ganti Password <span class="text-slate-400 normal-case">(Opsional)</span></label>
                    <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3" placeholder="Kosongkan jika tidak ingin mengganti password">
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-cyan-500/30 hover:-translate-y-0.5 transition-transform">
                    Perbarui Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
