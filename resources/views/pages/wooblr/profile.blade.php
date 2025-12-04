<?php
use function Laravel\Folio\{name, middleware};

name('wooblr.profile');
middleware(['auth:wooblr']);
?>

<x-wooblr.blocks.app>
    <x-slot:title>
        Profile Saya
    </x-slot:title>
    <x-slot:breadcrumb>
        <x-wooblr.ui.breadcrumb :items="[
            'Dashboard' => route('wooblr.index'),
            'Profile Saya' => '#',
        ]" />
    </x-slot:breadcrumb>

    <x-wooblr.blocks.main>
        <livewire:wooblr.components.profile-form />
    </x-wooblr.blocks.main>
</x-wooblr.blocks.app>
