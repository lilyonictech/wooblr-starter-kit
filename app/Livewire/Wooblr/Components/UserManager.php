<?php

namespace App\Livewire\Wooblr\Components;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{

    use WithPagination;

    public $search = '';

    #[On('reload-users')]
    public function reloadRecords()
    {
        unset($this->records);
    }

    #[Computed]
    public function records()
    {
        return User::query()->with(['roles'])->search($this->search)->latest()->paginate(10);
    }

    public function render()
    {
        return view('livewire.wooblr.components.⚡user-manager');
    }
}
