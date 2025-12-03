<?php

namespace App\Livewire\Wooblr\Ui;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::guard('wooblr')->logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect(route('wooblr.auth'));
    }

    public function render()
    {
        return view('livewire.wooblr.ui.⚡logout');
    }
}
