<?php

namespace App\Livewire\Wooblr\Components;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use TallStackUi\Traits\Interactions;

class UserForm extends Component
{

    use Interactions;

    public bool $isOpen = false;
    public ?string $eventName = null;
    public ?string $eventTitle = null;
    public ?int $eventId = null;

    public $name;
    public $email;
    public $password;
    public $selectedRoles = [];

    public $roles;

    public function mount()
    {
        $this->roles = Role::query()->orderBy('name')->get();
    }

    public function loadRecord($id)
    {
        $this->dispatch('close-modal-loading');
        $record = User::query()->with(['roles'])->find($id);

        if (!$record) {
        }
        $this->name = $record->name;
        $this->email = $record->email;
        $this->selectedRoles = $record->roles->pluck('name')->map(fn($val) => (string) $val)->toArray();
        $this->isOpen = true;
    }

    public function save()
    {
        // Validasi
        $rules = [
            'name'                  => 'required|min:3',
            'email'                 => ['required', 'email', Rule::unique('users', 'email')->ignore($this->eventId)],
            'selectedRoles'         => 'required|array|min:1',
        ];

        // Jika mode create, password wajib. Jika edit, boleh kosong.
        $rules['password']      =  (!$this->eventId) ? 'required|min:6' : 'nullable|min:6';

        $this->validate($rules);

        // Data yang akan disimpan
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        // Hanya update password jika diisi
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user = User::updateOrCreate([
            'id' => $this->eventId
        ], $data);

        // Sync Roles
        $user->syncRoles($this->selectedRoles);

        $this->toast()->success('Sukses', 'Pengguna berhasil disimpan.')->send();
        $this->js('callbackModalClose');
        $this->dispatch('reload-users');
    }

    public function delete()
    {
        $user = User::find($this->eventId);
        if (!$user) {
            $this->toast()->error('Error', 'Pengguna tidak ditemukan!')->send();
            return;
        }

        if (auth('wooblr')->id() === $user->id) {
            $this->toast()->error('Error', 'Anda tidak bisa menghapus akun sendiri!')->send();
            return;
        }

        $user->delete();
        $this->toast()->success('Sukses', 'Pengguna berhasil dihapus.')->send();
        $this->js('callbackModalClose');
        $this->dispatch('reload-users');
    }

    public function render()
    {
        return view('livewire.wooblr.components.⚡user-form');
    }
}
