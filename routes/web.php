<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login'); // Arahkan halaman depan langsung ke login
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Kelompok Rute yang wajib Login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master Pasien & Rekam Medis (Bisa diakses Super Admin & Praktisi)
    Route::resource('patients', PatientController::class);
    Route::get('patients/{patient}/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('patients/{patient}/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
    Route::get('patients/{patient}/medical-records/{record}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
});

// Kelompok Rute Khusus Super Admin (Contoh untuk Master Keluhan nanti)
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    // Nanti rute pengaturan Keluhan atau Manajemen User ditaruh di sini
});

require __DIR__.'/auth.php';
