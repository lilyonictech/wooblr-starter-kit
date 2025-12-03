<?php
use function Laravel\Folio\{name, middleware};

name('wooblr.index');
middleware(['auth:wooblr']);
?>

<x-wooblr.blocks.app>
    <x-slot:title>
        Dashboard
    </x-slot:title>
    <x-slot:breadcrumb>
        <x-wooblr.ui.breadcrumb :items="[
            'Dashboard' => '#',
        ]" />
    </x-slot:breadcrumb>

    <x-wooblr.blocks.main>
        DASHBOARD
    </x-wooblr.blocks.main>
</x-wooblr.blocks.app>
