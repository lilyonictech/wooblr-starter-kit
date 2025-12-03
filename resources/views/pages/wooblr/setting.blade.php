<?php
use function Laravel\Folio\{name, middleware};

name('wooblr.setting');
middleware(['auth:wooblr']);
?>

<x-wooblr.blocks.app>
    <x-slot:title>
        Pengaturan
    </x-slot:title>
    <x-slot:breadcrumb>
        <x-wooblr.ui.breadcrumb :items="[
            'Dashboard' => route('wooblr.index'),
            'Pengaturan' => '#',
        ]" />
    </x-slot:breadcrumb>

    <x-wooblr.blocks.main>
        <livewire:wooblr.components.general-setting-form />
    </x-wooblr.blocks.main>
</x-wooblr.blocks.app>
