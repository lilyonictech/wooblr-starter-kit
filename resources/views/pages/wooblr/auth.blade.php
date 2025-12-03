<?php
use function Laravel\Folio\{name, middleware};

name('wooblr.auth');
middleware('guest');
?>

<x-layouts.wooblr>
    <x-slot:title>
        Masuk
    </x-slot:title>

    <livewire:wooblr.components.auth lazy="on-load" />
</x-layouts.wooblr>
