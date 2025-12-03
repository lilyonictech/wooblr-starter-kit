<x-layouts.wooblr>
    <x-slot:title>
        {{ $title ?? 'Not Found' }}
    </x-slot:title>
    <div class="flex">
        <x-wooblr.blocks.sidebar />
        <main
            class="flex-1 min-w-0 max-w-full w-full min-h-[calc(100vh-16px)] flex flex-col md:my-2 md:mr-2 md:shadow-sm md:rounded-xl bg-white"
            x-bind:class="!isMobile && !sidebarToggle ? 'ml-2' : ''">
            <x-wooblr.blocks.header>
                <nav>
                    <ol class="flex flex-wrap items-center gap-1.5 text-sm sm:gap-2.5">
                        {{ $breadcrumb ?? '' }}
                    </ol>
                </nav>
            </x-wooblr.blocks.header>
            <div class="p-4 md:p-6 flex-1">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-layouts.wooblr>
