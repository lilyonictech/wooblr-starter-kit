<?php
use function Laravel\Folio\{name, middleware};

name('wooblr.roles');
middleware(['auth:wooblr']);
?>

<x-wooblr.blocks.app>
    <x-slot:title>
        Peran & Izin
    </x-slot:title>
    <x-slot:breadcrumb>
        <x-wooblr.ui.breadcrumb :items="[
            'Dashboard' => route('wooblr.index'),
            'Peran & Izin' => '#',
        ]" />
    </x-slot:breadcrumb>

    <x-wooblr.blocks.main>
        <livewire:wooblr.components.roles-manager />
    </x-wooblr.blocks.main>

    @push('js')
        <livewire:wooblr.components.roles-form lazy="on-load" />
    @endpush
</x-wooblr.blocks.app>
