<header
    class="sticky top-0 z-30 flex h-16 w-full items-center justify-between border-b border-zinc-200 bg-white/90 px-4 py-3 backdrop-blur-md rounded-t-xl transition-all md:px-6">

    <div class="flex items-center gap-4">

        <button type="button"
            class="group inline-flex size-9 items-center justify-center rounded-lg border border-zinc-200 bg-white text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none"
            x-on:click="sidebarToggle = !sidebarToggle">
            <i class="hgi hgi-stroke hgi-sidebar-left text-xl transition-transform group-hover:scale-110"></i>
        </button>

        <div class="h-6 w-px bg-zinc-200 hidden md:block"></div>

        <nav class="flex items-center text-sm font-medium text-zinc-600 min-w-0">
            <div class="flex items-center gap-2 overflow-hidden whitespace-nowrap mask-linear-fade">
                {{ $slot }}
            </div>
        </nav>

        <div id="header-primary-left"></div>
    </div>

    <div id="header-primary-right" class="flex items-center gap-3">

        <button
            class="relative rounded-lg p-2 text-zinc-400 hover:bg-zinc-100 size-10 hover:text-zinc-600 transition-colors flex items-center justify-center">
            <i class="hgi hgi-stroke hgi-notification-03 text-xl"></i>
            <span class="absolute top-2 right-2 size-2 bg-red-500 rounded-full border-2 border-white"></span>
        </button>
    </div>
</header>
