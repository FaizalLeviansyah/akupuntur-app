@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto pb-12">

    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <a href="{{ route('patients.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Rekam <span class="text-blue-600">Medis Baru</span></h1>
                <p class="text-slate-500 text-xs font-medium mt-0.5">Pengisian LDP Praktis & LKP Mandiri</p>
            </div>
        </div>

        <div class="mt-4 md:mt-0 flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-100">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                {{ substr($patient->name, 0, 1) }}
            </div>
            <div>
                <p class="text-xs font-bold text-slate-800">{{ $patient->name }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest">{{ $patient->registration_number }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">

        <div class="bg-slate-50 border-b border-slate-100 p-6 sm:px-10 relative overflow-hidden">
            <div class="relative z-10 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex flex-col items-center w-full">
                    <div class="flex items-center w-full relative">
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full z-0"></div>
                        <div id="progress-bar" class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-blue-500 rounded-full z-0 transition-all duration-500" style="width: 0%;"></div>

                        <div class="w-full flex justify-between z-10">
                            <div class="step-indicator flex flex-col items-center gap-2" data-step="1">
                                <div class="w-8 h-8 rounded-full border-2 border-blue-500 bg-blue-500 text-white flex items-center justify-center font-bold text-xs transition-colors shadow-lg shadow-blue-500/30">1</div>
                                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-slate-50 px-1">Wawancara (問)</span>
                            </div>
                            <div class="step-indicator flex flex-col items-center gap-2" data-step="2">
                                <div class="w-8 h-8 rounded-full border-2 border-slate-300 bg-white text-slate-400 flex items-center justify-center font-bold text-xs transition-colors">2</div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-1">Fisik (望)</span>
                            </div>
                            <div class="step-indicator flex flex-col items-center gap-2" data-step="3">
                                <div class="w-8 h-8 rounded-full border-2 border-slate-300 bg-white text-slate-400 flex items-center justify-center font-bold text-xs transition-colors">3</div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-1">Nadi & Titik (切)</span>
                            </div>
                            <div class="step-indicator flex flex-col items-center gap-2" data-step="4">
                                <div class="w-8 h-8 rounded-full border-2 border-slate-300 bg-white text-slate-400 flex items-center justify-center font-bold text-xs transition-colors">4</div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-1">Diagnosis</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 sm:p-10">
            <form id="medical-form" action="{{ route('medical-records.store', $patient->id) }}" method="POST">
                @csrf

                <div class="step-content hidden animate-fade-in-up" data-step="1">
                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">I. Anamnesis / Wawancara (問)</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Keluhan Utama <span class="text-red-500">*</span></label>
                            <textarea name="keluhan_utama" rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors" placeholder="Apa yang dirasakan pasien saat ini?" required></textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Keluhan Tambahan</label>
                            <textarea name="keluhan_tambahan" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors"></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Riwayat Penyakit Sekarang</label>
                                <textarea name="riwayat_penyakit_sekarang" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors"></textarea>
                            </div>
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Riwayat Penyakit Dahulu</label>
                                <textarea name="riwayat_penyakit_dahulu" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="step-content hidden animate-fade-in-up" data-step="2">
                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">II. Pemeriksaan Fisik / Pengamatan (望)</h3>
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-sm font-bold text-slate-700 mb-4 border-b border-slate-100 pb-2 text-blue-600">Pengamatan Lidah</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Warna Otot Lidah</label>
                                    <input type="text" name="lidah_warna" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors">
                                </div>
                                <div>
                                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Bentuk Lidah</label>
                                    <input type="text" name="lidah_bentuk" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors">
                                </div>
                                <div>
                                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Selaput / Lumut</label>
                                    <input type="text" name="lidah_selaput" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-bold text-slate-700 mb-4 border-b border-slate-100 pb-2 text-blue-600">Keadaan Jiwa (神) & Wajah</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Kesadaran (Shen)</label>
                                    <input type="text" name="shen_kesadaran" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors">
                                </div>
                                <div>
                                    <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Warna Wajah</label>
                                    <input type="text" name="warna_wajah" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="step-content hidden animate-fade-in-up" data-step="3">
                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">III. Pemeriksaan Nadi & Titik (切)</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div class="p-6 border border-slate-200 rounded-2xl bg-white shadow-sm relative overflow-hidden">
                            <div class="absolute right-0 top-0 w-2 h-full bg-blue-500"></div>
                            <h4 class="font-bold text-blue-600 mb-4 text-sm uppercase tracking-wider">Tangan Kanan</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Cun (寸) - Paru</label>
                                    <input type="text" name="nadi_kanan[cun]" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg focus:ring-blue-500 p-2.5">
                                </div>
                                <div>
                                    <label class="block mb-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Guan (關) - Limpa</label>
                                    <input type="text" name="nadi_kanan[guan]" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg focus:ring-blue-500 p-2.5">
                                </div>
                                <div>
                                    <label class="block mb-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Chi (尺) - Ming Men</label>
                                    <input type="text" name="nadi_kanan[chi]" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg focus:ring-blue-500 p-2.5">
                                </div>
                            </div>
                        </div>
                        <div class="p-6 border border-slate-200 rounded-2xl bg-white shadow-sm relative overflow-hidden">
                            <div class="absolute right-0 top-0 w-2 h-full bg-pink-500"></div>
                            <h4 class="font-bold text-pink-600 mb-4 text-sm uppercase tracking-wider">Tangan Kiri</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Cun (寸) - Jantung</label>
                                    <input type="text" name="nadi_kiri[cun]" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg focus:ring-pink-500 p-2.5">
                                </div>
                                <div>
                                    <label class="block mb-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Guan (關) - Hati</label>
                                    <input type="text" name="nadi_kiri[guan]" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg focus:ring-pink-500 p-2.5">
                                </div>
                                <div>
                                    <label class="block mb-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Chi (尺) - Ginjal</label>
                                    <input type="text" name="nadi_kiri[chi]" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg focus:ring-pink-500 p-2.5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-slate-700 mb-4 border-b border-slate-100 pb-2 text-blue-600">Tabel Titik Evaluasi</h4>
                    <div class="overflow-x-auto rounded-2xl border border-slate-200">
                        <table class="w-full text-sm text-left text-slate-600">
                            <thead class="text-[10px] font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-4">Meridian</th>
                                    <th class="px-6 py-4 text-center border-l border-slate-200">Yuan (原)</th>
                                    <th class="px-6 py-4 text-center border-l border-slate-200">Shu (俞)</th>
                                    <th class="px-6 py-4 text-center border-l border-slate-200">Mu (募)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @php
                                    $meridians = [
                                        'LU' => 'Paru-Paru', 'LI' => 'Usus Besar', 'ST' => 'Lambung',
                                        'SP' => 'Limpa', 'HT' => 'Jantung', 'SI' => 'Usus Kecil',
                                        'BL' => 'Kandung Kemih', 'KI' => 'Ginjal', 'PC' => 'Selaput Jantung',
                                        'TE' => 'Tri Pemanas', 'GB' => 'Kandung Empedu', 'LR' => 'Hati'
                                    ];
                                @endphp
                                @foreach($meridians as $code => $name)
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-3 font-medium text-slate-800">{{ $name }} <span class="text-[10px] bg-slate-100 px-1 rounded ml-1 font-mono text-slate-500">{{ $code }}</span></td>
                                    <td class="px-6 py-3 text-center border-l border-slate-100">
                                        <input type="checkbox" name="points[{{ $code }}][yen]" class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                                        <input type="hidden" name="points[{{ $code }}][meridian]" value="{{ $name }}">
                                    </td>
                                    <td class="px-6 py-3 text-center border-l border-slate-100">
                                        <input type="checkbox" name="points[{{ $code }}][su]" class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                                    </td>
                                    <td class="px-6 py-3 text-center border-l border-slate-100">
                                        <input type="checkbox" name="points[{{ $code }}][mu]" class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="step-content hidden animate-fade-in-up" data-step="4">
                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">IV. Diagnosis & Rencana Terapi</h3>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Diagnosis Penyakit</label>
                                <input type="text" name="diagnosis_penyakit" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors">
                            </div>
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Diagnosis Sindrom</label>
                                <input type="text" name="diagnosis_sindrom" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Pemilihan Titik Akupuntur</label>
                            <textarea name="titik_akupuntur" rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors" placeholder="Ketik titik yang akan digunakan..."></textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Anjuran / Saran Perawatan</label>
                            <textarea name="saran_anjuran" rows="2" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-4 transition-colors"></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-10 pt-6 border-t border-slate-100">
                    <button type="button" id="btn-prev" class="hidden px-6 py-3 text-sm font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Kembali
                    </button>

                    <div class="ml-auto">
                        <button type="button" id="btn-next" class="bg-slate-800 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg hover:bg-slate-700 transition-all flex items-center gap-2">
                            Selanjutnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                        <button type="submit" id="btn-submit" class="hidden bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transform hover:-translate-y-0.5 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Rekam Medis
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentStep = 1;
        const totalSteps = 4;

        const btnNext = document.getElementById('btn-next');
        const btnPrev = document.getElementById('btn-prev');
        const btnSubmit = document.getElementById('btn-submit');
        const progressBar = document.getElementById('progress-bar');

        function updateUI() {
            document.querySelectorAll('.step-content').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelector(`.step-content[data-step="${currentStep}"]`).classList.remove('hidden');

            document.querySelectorAll('.step-indicator').forEach(el => {
                const step = parseInt(el.getAttribute('data-step'));
                const circle = el.querySelector('div');
                const label = el.querySelector('span');

                if (step === currentStep) {
                    circle.className = 'w-8 h-8 rounded-full border-2 border-blue-500 bg-blue-500 text-white flex items-center justify-center font-bold text-xs transition-colors shadow-lg shadow-blue-500/30';
                    label.className = 'text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-slate-50 px-1';
                } else if (step < currentStep) {
                    circle.className = 'w-8 h-8 rounded-full border-2 border-blue-500 bg-white text-blue-500 flex items-center justify-center font-bold text-xs transition-colors';
                    label.className = 'text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-1';
                } else {
                    circle.className = 'w-8 h-8 rounded-full border-2 border-slate-300 bg-white text-slate-400 flex items-center justify-center font-bold text-xs transition-colors';
                    label.className = 'text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-1';
                }
            });

            progressBar.style.width = ((currentStep - 1) / (totalSteps - 1)) * 100 + '%';

            if (currentStep === 1) {
                btnPrev.classList.add('hidden');
            } else {
                btnPrev.classList.remove('hidden');
            }

            if (currentStep === totalSteps) {
                btnNext.classList.add('hidden');
                btnSubmit.classList.remove('hidden');
            } else {
                btnNext.classList.remove('hidden');
                btnSubmit.classList.add('hidden');
            }
        }

        btnNext.addEventListener('click', () => {
            if (currentStep < totalSteps) {
                const currentInputs = document.querySelectorAll(`.step-content[data-step="${currentStep}"] [required]`);
                let isValid = true;
                currentInputs.forEach(input => {
                    if (!input.value) {
                        isValid = false;
                        input.classList.add('border-red-500');
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });

                if (isValid) {
                    currentStep++;
                    updateUI();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Belum Lengkap',
                        text: 'Harap isi semua kolom wajib (bertanda merah) sebelum melanjutkan.',
                        confirmButtonColor: '#3b82f6'
                    });
                }
            }
        });

        btnPrev.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateUI();
            }
        });

        updateUI();
    });
</script>

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.4s ease-out forwards; }
</style>
@endsection
