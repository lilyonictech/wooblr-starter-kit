<?php

namespace App\Livewire\Wooblr\Components;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class GeneralSettingForm extends Component
{

    use WithFileUploads, Interactions;

    // State Form
    public $site_name;
    public $site_description;
    public $contact_email;

    // Uploads
    public $site_logo;
    public $existing_logo;

    public $site_favicon;
    public $existing_favicon;

    public function mount()
    {
        // Ambil data baris pertama. Jika tidak ada, buat baru.
        $settings = GeneralSetting::query()
            ->firstOrCreate([], ['site_name' => 'My Wooblr']);

        $this->site_name            = $settings->site_name;
        $this->site_description     = $settings->site_description;
        $this->contact_email        = $settings->contact_email;
        $this->existing_logo        = $settings->site_logo;
        $this->existing_favicon     = $settings->site_favicon;
    }

    public function save()
    {
        $this->validate([
            'site_name'         => 'required|string|max:255',
            'site_description'  => 'nullable|string|max:500',
            'contact_email'     => 'nullable|email',
            'site_logo'         => 'nullable|image|max:1024', // 1MB Max
            'site_favicon'      => 'nullable|image|max:512',
        ]);

        $settings = GeneralSetting::first();

        // Logic Upload Logo
        if ($this->site_logo) {
            // Hapus logo lama jika ada dan bukan default
            if ($settings->site_logo && Storage::disk('public')->exists($settings->site_logo)) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            // Simpan yang baru
            $settings->site_logo = $this->site_logo->store('settings', 'public');
        }

        // Logic Upload Favicon
        if ($this->site_favicon) {
            if ($settings->site_favicon && Storage::disk('public')->exists($settings->site_favicon)) {
                Storage::disk('public')->delete($settings->site_favicon);
            }
            $settings->site_favicon = $this->site_favicon->store('settings', 'public');
        }

        $settings->update([
            'site_name'         => $this->site_name,
            'site_description'  => $this->site_description,
            'contact_email'     => $this->contact_email,
        ]);

        // Reset file input biar bersih
        $this->site_logo = null;
        $this->site_favicon = null;

        // Refresh view data
        $this->redirect(route('wooblr.setting'), true);
        $this->toast()->success('Sukses', 'Pengaturan berhasil diperbarui.')->send();
    }

    public function render()
    {
        return view('livewire.wooblr.components.⚡general-setting-form');
    }
}
