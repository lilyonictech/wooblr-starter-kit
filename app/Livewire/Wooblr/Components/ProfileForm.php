<?php

namespace App\Livewire\Wooblr\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ProfileForm extends Component
{

    use Interactions;

    public bool $isOpen = false;
    public ?string $eventName = null;

    // Profile Data
    public $name;
    public $email;

    // Password Data
    public $current_password;
    public $password;
    public $password_confirmation;

    public $delete_password;

    public function mount()
    {
        $user = Auth::guard('wooblr')->user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfileInformation()
    {
        $user = Auth::guard('wooblr')->user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->fill($validated);

        // Jika email berubah, reset verifikasi (opsional, tergantung logic app mu)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Refresh view data
        $this->redirect(route('wooblr.profile'), true);
        $this->toast()->success('Sukses', 'Profil berhasil diperbarui.')->send();
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password'  => ['required', 'current_password'],
            'password'          => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        Auth::guard('wooblr')
            ->user()->update([
                'password' => Hash::make($this->password),
            ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        $this->redirect(route('wooblr.profile'), true);
        $this->toast()->success('Sukses', 'Password berhasil diubah.')->send();
    }

    public function deleteAccount()
    {
        $this->validate([
            'delete_password' => ['required', 'current_password'],
        ]);

        $user = Auth::guard('wooblr')->user();

        Auth::guard('wooblr')->logout();

        $user->delete();

        session()->invalidate();
        session()->regenerateToken();

        return $this->redirect(route('wooblr.auth'));
    }

    public function render()
    {
        return view('livewire.wooblr.components.⚡profile-form');
    }
}
