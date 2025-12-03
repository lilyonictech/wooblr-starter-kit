<?php
use function Laravel\Folio\{name, middleware};

name('wooblr.user');
middleware(['auth:wooblr']);
?>

<x-wooblr.blocks.app>
    <x-slot:title>
        Pengguna
    </x-slot:title>
    <x-slot:breadcrumb>
        <x-wooblr.ui.breadcrumb :items="[
            'Dashboard' => route('wooblr.index'),
            'Pengguna' => '#',
        ]" />
    </x-slot:breadcrumb>

    <x-wooblr.blocks.main>
        <livewire:wooblr.components.user-manager />
    </x-wooblr.blocks.main>

    @push('js')
        <livewire:wooblr.components.user-form lazy="on-load" />
    @endpush
</x-wooblr.blocks.app>
