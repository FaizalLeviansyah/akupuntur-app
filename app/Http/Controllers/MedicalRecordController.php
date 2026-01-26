<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function create(Patient $patient)
    {
        return view('medical_records.create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'keluhan_utama' => 'required|string',
            'keluhan_tambahan' => 'nullable|string',
            'diagnosis_penyakit' => 'nullable|string',
            'diagnosis_sindrom' => 'nullable|string',
        ]);

        $patient->medicalRecords()->create($request->all());

        return redirect()->route('patients.show', $patient->id)->with('success', 'Rekam medis berhasil disimpan');
    }
}
