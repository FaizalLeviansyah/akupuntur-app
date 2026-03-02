<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

class UserManager extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;

    // Form properties
    public $user_id, $name, $email, $role, $password;

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.user-manager', compact('users'))
               ->extends('layouts.app')
               ->section('content');
    }

    public function create()
    {
        $this->resetForm();
        $this->role = 'praktisi'; // Set default
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $user = User::findOrFail($id);

        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = ''; // Dikosongkan, hanya diisi jika ingin diubah

        $this->isModalOpen = true;
    }

    public function store()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|in:super_admin,praktisi',
        ];

        // Jika buat baru ATAU password diisi saat edit
        if (!$this->user_id || !empty($this->password)) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        // Jika user baru, set default is_active ke true
        if (!$this->user_id) {
            $data['is_active'] = true;
        }

        User::updateOrCreate(['id' => $this->user_id], $data);

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => $this->user_id ? 'Data pengguna diperbarui.' : 'Pengguna baru ditambahkan.'
        ]);

        $this->closeModal();
        $this->resetForm();
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Cegah menonaktifkan diri sendiri
        if ($user->id === auth()->id()) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => 'Akses Ditolak!',
                'text' => 'Anda tidak bisa menonaktifkan akun yang sedang digunakan.'
            ]);
            return;
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Status Diubah!',
            'text' => 'Akses pengguna telah diperbarui.'
        ]);
    }

    public function deleteConfirm($id)
    {
        if ($id == auth()->id()) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => 'Akses Ditolak!',
                'text' => 'Anda tidak bisa menghapus akun sendiri.'
            ]);
            return;
        }

        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Hapus Pengguna?',
            'text' => 'Pengguna tidak akan bisa mengakses sistem lagi.'
        ]);
    }

    #[On('deleteConfirmed')]
    public function deleteUser($id)
    {
        User::findOrFail($id['id'])->delete();

        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Dihapus!',
            'text' => 'Data pengguna telah dihapus.'
        ]);
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->user_id = '';
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
    }
}
