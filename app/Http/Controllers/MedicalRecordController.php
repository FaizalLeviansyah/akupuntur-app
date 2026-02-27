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
            'riwayat_penyakit_sekarang' => 'nullable|string',
            'riwayat_penyakit_dahulu' => 'nullable|string',
            'shen_kesadaran' => 'nullable|string',
            'warna_wajah' => 'nullable|string',
            'lidah_warna' => 'nullable|string',
            'lidah_bentuk' => 'nullable|string',
            'lidah_selaput' => 'nullable|string',
            'nadi_kanan' => 'nullable|array',
            'nadi_kiri' => 'nullable|array',
            'diagnosis_penyakit' => 'nullable|string',
            'diagnosis_sindrom' => 'nullable|string',
            'titik_akupuntur' => 'nullable|string',
            'saran_anjuran' => 'nullable|string',
            'points' => 'nullable|array'
        ]);

        $medicalRecord = $patient->medicalRecords()->create([
            'keluhan_utama' => $validated['keluhan_utama'],
            'keluhan_tambahan' => $validated['keluhan_tambahan'] ?? null,
            'riwayat_penyakit_sekarang' => $validated['riwayat_penyakit_sekarang'] ?? null,
            'riwayat_penyakit_dahulu' => $validated['riwayat_penyakit_dahulu'] ?? null,
            'shen_kesadaran' => $validated['shen_kesadaran'] ?? null,
            'warna_wajah' => $validated['warna_wajah'] ?? null,
            'lidah_warna' => $validated['lidah_warna'] ?? null,
            'lidah_bentuk' => $validated['lidah_bentuk'] ?? null,
            'lidah_selaput_warna' => $validated['lidah_selaput'] ?? null,
            'nadi_kanan' => isset($validated['nadi_kanan']) ? json_encode($validated['nadi_kanan']) : null,
            'nadi_kiri' => isset($validated['nadi_kiri']) ? json_encode($validated['nadi_kiri']) : null,
            'diagnosis_penyakit' => $validated['diagnosis_penyakit'] ?? null,
            'diagnosis_sindrom' => $validated['diagnosis_sindrom'] ?? null,
            'titik_akupuntur' => $validated['titik_akupuntur'] ?? null,
            'saran_anjuran' => $validated['saran_anjuran'] ?? null,
        ]);

        if ($request->has('points')) {
            foreach ($request->points as $code => $pointData) {
                if (isset($pointData['yen']) || isset($pointData['su']) || isset($pointData['mu'])) {
                    $medicalRecord->pointChecks()->create([
                        'meridian_name' => $pointData['meridian'],
                        'yen_point' => isset($pointData['yen']),
                        'su_point' => isset($pointData['su']),
                        'mu_point' => isset($pointData['mu']),
                    ]);
                }
            }
        }

        return redirect()->route('medical-records.show', [$patient->id, $medicalRecord->id])
                         ->with('success', 'Rekam Medis berhasil disimpan.');
    }

    public function show($patientId, $recordId)
    {
        $patient = Patient::findOrFail($patientId);
        $record = MedicalRecord::with('pointChecks')->findOrFail($recordId);

        return view('medical_records.show', compact('patient', 'record'));
    }
}
