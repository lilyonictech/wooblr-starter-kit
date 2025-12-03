<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scheme-light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Not Found' }} | {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Styles / Scripts -->
    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
    <style>
        /* CSS Utility Tambahan untuk mask breadcrumb panjang */
        .mask-linear-fade {
            mask-image: linear-gradient(to right, black 90%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, black 90%, transparent 100%);
        }
    </style>
</head>

<body class="bg-[#fafafa] touch-manipulation !pr-0 antialiased overscroll-none" x-data="{
    sidebarToggle: window.innerWidth <= 768 ? false : true,
    isMobile: window.innerWidth <= 768
}"
    x-init="window.addEventListener('resize', () => {
        isMobile = window.innerWidth <= 768;
        sidebarToggle = window.innerWidth <= 768 ? false : true;
    })" x-trap.noscroll="window.innerWidth <= 768 ? sidebarToggle : false">
    @persist('toast')
        <x-toast />
    @endpersist
    @persist('dialog')
        <x-dialog />
    @endpersist

    {{ $slot }}

    <template x-if="isMobile">
        <div id="backdrop" x-show="sidebarToggle" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" x-on:click="sidebarToggle = false"
            class="fixed z-30 bg-black/60 inset-0">
        </div>
    </template>
    @persist('modal-loading')
        <x-wooblr.ui.modal-loading />
    @endpersist
    @stack('js')
    @livewireScriptConfig
</body>

</html>
