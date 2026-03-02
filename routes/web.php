<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Livewire\PatientManager;
use App\Livewire\UserManager;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// KELOMPOK RUTE UMUM (Super Admin & Praktisi)
Route::middleware('auth')->group(function () {

    // Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // SPA Livewire: Tabel Manajemen Pasien
    Route::get('/patients', PatientManager::class)->name('patients.index');
    // Halaman Detail (Timeline Pasien) menggunakan Controller Biasa
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');

    // Form Rekam Medis & Cetak PDF (Controller Biasa)
    Route::get('patients/{patient}/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('patients/{patient}/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
    Route::get('patients/{patient}/medical-records/{record}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
    Route::get('patients/{patient}/medical-records/{record}/pdf', [MedicalRecordController::class, 'downloadPdf'])->name('medical-records.pdf');
});

// KELOMPOK RUTE KHUSUS (Hanya Super Admin)
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    // SPA Livewire: Tabel Manajemen Pengguna
    // PERBAIKAN: Namanya cukup 'users.index' karena sudah ada prefix 'admin.' di group atasnya
    Route::get('/users', UserManager::class)->name('users.index');
});

require __DIR__.'/auth.php';
