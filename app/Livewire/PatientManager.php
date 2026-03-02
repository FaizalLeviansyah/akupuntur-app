<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patient;
use Livewire\Attributes\On;

class PatientManager extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;

    // Properti Form
    public $patient_id, $registration_number, $name, $age, $gender;

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage(); // Reset halaman saat mengetik pencarian
    }

    public function render()
    {
        $patients = Patient::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('registration_number', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        // Render ke layout app.blade.php kita
        return view('livewire.patient-manager', compact('patients'))
               ->extends('layouts.app')
               ->section('content');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->resetErrorBag();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetCreateForm()
    {
        $this->patient_id = '';
        $this->registration_number = '';
        $this->name = '';
        $this->age = '';
        $this->gender = '';
    }

    public function store()
    {
        $this->validate([
            'registration_number' => 'required|unique:patients,registration_number,' . $this->patient_id,
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'gender' => 'required|in:L,P',
        ]);

        Patient::updateOrCreate(['id' => $this->patient_id], [
            'registration_number' => $this->registration_number,
            'name' => $this->name,
            'age' => $this->age,
            'gender' => $this->gender,
        ]);

        // Trigger SweetAlert sukses
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => $this->patient_id ? 'Data Pasien diperbarui.' : 'Pasien baru ditambahkan.'
        ]);

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $this->patient_id = $id;
        $this->registration_number = $patient->registration_number;
        $this->name = $patient->name;
        $this->age = $patient->age;
        $this->gender = $patient->gender;

        $this->openModal();
    }

    public function deleteConfirm($id)
    {
        // Trigger SweetAlert Konfirmasi Hapus
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Hapus Pasien?',
            'text' => 'Data pasien beserta riwayat rekam medisnya akan dihapus permanen.'
        ]);
    }

    #[On('deleteConfirmed')]
    public function deletePatient($id)
    {
        Patient::findOrFail($id['id'])->delete();

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Dihapus!',
            'text' => 'Data pasien telah dihapus.'
        ]);
    }
}
