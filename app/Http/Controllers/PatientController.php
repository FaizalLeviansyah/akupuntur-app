<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%");
        }

        $patients = $query->latest()->paginate(10)->withQueryString();

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
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required|in:L,P',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'registration_number' => 'required|unique:patients,registration_number,' . $patient->id,
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required|in:L,P',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus');
    }

    public function show(Patient $patient)
    {
        $patient->load(['medicalRecords' => function($query) {
            $query->latest();
        }]);

        return view('patients.show', compact('patient'));
    }
}
