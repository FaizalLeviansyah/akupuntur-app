<div class="max-w-7xl mx-auto">

    {{-- Loader SPA --}}
    <div wire:loading class="fixed top-4 left-1/2 transform -translate-x-1/2 z-[9999]">
        <span class="bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg flex items-center gap-2">
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            Memproses...
        </span>
    </div>

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 animate-fade-in-up">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">Manajemen <span class="text-blue-600">Pengguna</span></h1>
            <p class="text-slate-500 text-xs font-medium mt-1">Kelola akses staf klinik secara Real-time.</p>
        </div>
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 shadow-sm transition-all" placeholder="Cari nama atau email...">
            </div>

            <button wire:click="create" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-5 py-3 rounded-xl text-sm font-bold shadow-lg hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pengguna
            </button>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-sm text-left text-slate-600 min-w-[800px]">
                <thead class="text-[11px] text-slate-500 uppercase tracking-widest bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 font-black">Profil Pengguna</th>
                        <th class="px-6 py-4 font-black">Hak Akses</th>
                        <th class="px-6 py-4 font-black text-center">Status Login</th>
                        <th class="px-6 py-4 font-black text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-blue-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg shrink-0">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800">{{ $user->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border {{ $user->role == 'super_admin' ? 'bg-purple-50 text-purple-600 border-purple-100' : 'bg-slate-50 text-slate-600 border-slate-200' }}">
                                {{ str_replace('_', ' ', $user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button wire:click="toggleStatus({{ $user->id }})" class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border transition-colors hover:shadow-md {{ $user->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-100 hover:bg-red-50 hover:text-red-600' : 'bg-red-50 text-red-600 border-red-100 hover:bg-emerald-50 hover:text-emerald-600' }}" title="Klik untuk ubah status">
                                {{ $user->is_active ? 'Aktif (Izinkan)' : 'Nonaktif (Tolak)' }}
                            </button>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button wire:click="edit({{ $user->id }})" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 border border-transparent hover:border-blue-100 rounded-xl transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button wire:click="deleteConfirm({{ $user->id }})" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 rounded-xl transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-slate-500 font-medium">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 sm:p-5 border-t border-slate-100 bg-slate-50/50">
            {{ $users->links() }}
        </div>
    </div>

    {{-- MODAL TAMBAH / EDIT --}}
    @if($isModalOpen)
    <div class="fixed inset-0 z-[9999] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/70 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/20">

            <div class="bg-gradient-to-r from-slate-50 to-blue-50 p-6 flex justify-between items-center border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-800 tracking-tight">
                    {{ $user_id ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
                </h3>
                <button wire:click="closeModal" class="text-slate-400 hover:text-red-500 transition-colors bg-white p-2 rounded-xl shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form wire:submit.prevent="store" class="p-6 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" wire:model="name" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3.5">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Email Login</label>
                        <input type="email" wire:model="email" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3.5">
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Hak Akses</label>
                        <select wire:model="role" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3.5">
                            <option value="praktisi">Praktisi (Dokter/Terapis)</option>
                            <option value="super_admin">Super Admin (IT)</option>
                        </select>
                        @error('role') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2 border-t border-slate-100 pt-4 mt-2">
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Password {{ $user_id ? '(Opsional)' : '*' }}</label>
                        <input type="password" wire:model="password" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl focus:ring-blue-500 p-3.5" placeholder="{{ $user_id ? 'Kosongkan jika tidak ingin mengubah password' : 'Isi minimal 6 karakter' }}">
                        @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 text-sm font-bold text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg hover:bg-blue-700 transition-all flex items-center gap-2">
                        <span wire:loading.remove wire:target="store">Simpan</span>
                        <span wire:loading wire:target="store">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
