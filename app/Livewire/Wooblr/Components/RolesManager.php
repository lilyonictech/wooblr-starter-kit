<?php

namespace App\Livewire\Wooblr\Components;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesManager extends Component
{

    #[On('reload-roles')]
    public function reloadRecords()
    {
        unset($this->records);
    }

    #[Computed]
    public function records()
    {
        return Role::query()
            ->withCount('permissions')
            ->withCount('users')
            ->with(['users' => function ($q) {
                $q->latest()->take(4);
            }])->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.wooblr.components.⚡roles-manager');
    }
}
