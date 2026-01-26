<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('patients.index');
});

Route::resource('patients', PatientController::class);
Route::get('patients/{patient}/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
Route::post('patients/{patient}/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
Route::get('patients/{patient}/medical-records/{record}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
