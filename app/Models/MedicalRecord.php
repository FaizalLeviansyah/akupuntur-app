<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $guarded = []; // Mengizinkan mass assignment untuk kemudahan

    // Relasi ke tabel Point Checks (Titik Yen, Mu, Su)
    public function pointChecks()
    {
        return $this->hasMany(PointCheck::class);
    }

    // Relasi balik ke Pasien
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function downloadPdf($patientId, $recordId)
    {
        $patient = Patient::findOrFail($patientId);
        $record = MedicalRecord::with('pointChecks')->findOrFail($recordId);

        // Memuat view khusus PDF
        $pdf = Pdf::loadView('medical_records.pdf', compact('patient', 'record'));

        // Mengatur ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'portrait');

        // Nama file saat di-download
        $fileName = 'Rekam_Medis_' . $patient->registration_number . '_' . $record->created_at->format('Ymd') . '.pdf';

        return $pdf->download($fileName);
    }
}
