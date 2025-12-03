<?php

namespace App\Livewire\Wooblr\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use TallStackUi\Traits\Interactions;

class RolesForm extends Component
{

    use Interactions;

    public bool $isOpen = false;
    public ?string $eventName = null;
    public ?string $eventTitle = null;
    public ?int $eventId = null;

    public $search = '';

    public $name;
    public $selectedPermissions = [];

    public function loadRecord($id)
    {
        $this->dispatch('close-modal-loading');
        $record = Role::query()->with(['permissions'])->find($id);

        if (!$record) {
        }
        $this->name = $record->name;
        $this->selectedPermissions = $record->permissions->pluck('name')->map(fn($val) => (string) $val)->toArray();
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate([
            'name'                  => ['required', 'min:3', Rule::unique('roles', 'name')->ignore($this->eventId)],
            'selectedPermissions'   => ['array']
        ]);

        $role = Role::firstOrCreate(['id' => $this->eventId], ['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);

        $this->toast()->success('Sukses', 'Peran berhasil disimpan.')->send();
        $this->js('callbackModalClose');
        $this->dispatch('reload-roles');
    }

    public function delete()
    {
        $role = Role::find($this->eventId);
        if (!$role) {
            $this->toast()->error('Error', 'Role tidak ditemukan!')->send();
            return;
        }
        // Security Guard
        if ($role->name === 'Owner') {
            $this->toast()->error('Error', 'Role Owner tidak boleh dihapus!')->send();
            return;
        }

        $role->delete();
        $this->toast()->success('Sukses', 'Peran berhasil dihapus.')->send();
        $this->js('callbackModalClose');
        $this->dispatch('reload-roles');
    }

    #[Computed]
    public function groupedPermissions()
    {
        $permissions = Cache::rememberForever('permissions', function () {
            return Permission::query()
                ->get()
                ->groupBy(fn($perm) => Str::before($perm->name, '.'))
                ->map(fn($group) => $group->map(function ($perm) {
                    $action = Str::after($perm->name, '.');
                    // Asumsi function actionLabels() tersedia global atau di trait
                    $perm->label = actionLabels($action) ?? ucfirst($action);
                    return $perm;
                }));
        });

        if (!empty($this->search)) {
            $searchTerm = strtolower($this->search);
            return $permissions->map(function ($group) use ($searchTerm) {
                // A. Filter ITEM di dalam setiap grup
                return $group->filter(function ($perm) use ($searchTerm) {
                    // Cari berdasarkan Nama Asli (user.create) ATAU Label (Membuat User)
                    return str_contains(strtolower($perm->name), $searchTerm) ||
                        str_contains(strtolower($perm->label), $searchTerm);
                });
            })->filter(function ($group) {
                // B. Hapus GRUP jika kosong (tidak ada item yang cocok di dalamnya)
                return $group->isNotEmpty();
            });
        }
        return $permissions;
    }

    public function render()
    {
        return view('livewire.wooblr.components.⚡roles-form');
    }
}
