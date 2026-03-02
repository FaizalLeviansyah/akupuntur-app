<div class="max-w-7xl mx-auto">

    {{-- Loader Saat Memproses Data (Interaktif SPA) --}}
    <div wire:loading class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50">
        <span class="bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg flex items-center gap-2">
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            Memproses...
        </span>
    </div>

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 animate-fade-in-up">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">
                Direktori <span class="text-blue-600">Pasien</span>
            </h1>
            <p class="text-slate-500 text-xs font-medium mt-1">Kelola data pasien secara Real-time.</p>
        </div>
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                {{-- Live Search Input --}}
                <input wire:model.live.debounce.300ms="search" type="text" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 shadow-sm transition-all" placeholder="Ketik nama pasien...">
            </div>

            <button wire:click="create" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-5 py-3 rounded-xl text-sm font-bold shadow-lg hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Pasien Baru
            </button>
        </div>
    </div>

    {{-- Data Table --}}
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
                                    <a href="{{ route('patients.show', $patient->id) }}" class="font-bold text-slate-800 hover:text-blue-600 transition-colors block text-base">
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
                                <a href="{{ route('medical-records.create', $patient->id) }}" class="flex items-center gap-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white px-4 py-2 rounded-xl text-xs font-bold transition-all border border-emerald-100 hover:shadow-lg hover:shadow-emerald-500/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Terapi Baru
                                </a>

                                <button wire:click="edit({{ $patient->id }})" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 border border-transparent hover:border-blue-100 rounded-xl transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>

                                <button wire:click="deleteConfirm({{ $patient->id }})" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 rounded-xl transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-300 mb-4 border border-slate-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-slate-500 text-sm font-bold">Data tidak ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 sm:p-5 border-t border-slate-100 bg-slate-50/50">
            {{ $patients->links() }}
        </div>
    </div>

    {{-- MODAL TAMBAH / EDIT --}}
    @if($isModalOpen)
    <div class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/60 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/20 animate-fade-in-up">

            <div class="bg-gradient-to-r from-slate-50 to-blue-50 p-6 flex justify-between items-center border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-800 tracking-tight">
                    {{ $patient_id ? 'Edit Data Pasien' : 'Registrasi Pasien Baru' }}
                </h3>
                <button wire:click="closeModal" class="text-slate-400 hover:text-red-500 transition-colors bg-white p-2 rounded-xl shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form wire:submit.prevent="store" class="p-6 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">No. Registrasi</label>
                        <input type="text" wire:model="registration_number" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 p-3.5" placeholder="e.g. REG-001">
                        @error('registration_number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" wire:model="name" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 p-3.5" placeholder="Sesuai KTP">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Usia (Tahun)</label>
                        <input type="number" wire:model="age" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 p-3.5" placeholder="0">
                        @error('age') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Jenis Kelamin</label>
                        <select wire:model="gender" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 p-3.5">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('gender') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 text-sm font-bold text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg hover:bg-blue-700 transition-all flex items-center gap-2">
                        <span wire:loading.remove wire:target="store">Simpan Data</span>
                        <span wire:loading wire:target="store">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
