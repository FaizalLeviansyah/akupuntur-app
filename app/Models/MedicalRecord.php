<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
