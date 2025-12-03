<?php

namespace App\Livewire\Wooblr\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Auth extends Component
{

    use Interactions;

    public $email     = 'owner@wooblr.com';
    public $password  = 'password';
    public $remember  = false;

    public function auth()
    {
        $this->validate([
            'email'     => ['required', 'email:filter'],
            'password'  => ['required', 'min:5'],
            'remember'  => ['boolean']
        ]);

        $user = User::query()
            ->select('id', 'password')
            ->where('email', $this->email)
            ->first();

        if (!$user || ($user && !Hash::check($this->password, $user?->password))) {
            throw ValidationException::withMessages([
                'email' => "Email atau Password salah.",
            ]);
        }

        try {

            $user->update([
                'last_loggined_at' => now()
            ]);

            FacadesAuth::guard('wooblr')->loginUsingId($user->id, $this->remember);
            session()->regenerate();
            $this->toast()->success('Berhasil masuk.')->send();
            $this->redirect(route('wooblr.index'), true);
        } catch (\Exception $e) {
            $this->dialog()->error('Something Wrong!', $e->getMessage())->send();
        }
    }

    public function render()
    {
        return view('livewire.wooblr.components.⚡auth');
    }
}
