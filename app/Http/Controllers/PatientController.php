<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Hanya menyisakan fungsi show untuk menampilkan Halaman Detail (Timeline)
    public function show(Patient $patient)
    {
        $patient->load(['medicalRecords' => function($query) {
            $query->latest();
        }]);

        return view('patients.show', compact('patient'));
    }
}
