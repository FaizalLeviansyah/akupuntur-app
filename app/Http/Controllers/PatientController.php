<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $patients = Patient::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('registration_number', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|unique:patients',
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:L,P',
            'phone' => 'nullable|string',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }
}
