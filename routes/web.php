<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

    // Manajemen Pasien
    Route::resource('patients', PatientController::class);

    // Rekam Medis
    Route::get('patients/{patient}/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('patients/{patient}/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
    Route::get('patients/{patient}/medical-records/{record}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
    Route::get('patients/{patient}/medical-records/{record}/pdf', [MedicalRecordController::class, 'downloadPdf'])->name('medical-records.pdf');
});

// KELOMPOK RUTE KHUSUS (Hanya Super Admin)
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    // Nanti rute pengaturan Keluhan ditaruh di sini
});

require __DIR__.'/auth.php';
