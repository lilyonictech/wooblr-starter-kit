<div x-data="{ open: false }" x-show="open" x-cloak
    class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center" role="dialog"
    x-on:open-modal-loading.window="open = true" x-on:close-modal-loading.window="open = false" x-trap.noscroll="open">
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-zinc-900/40 backdrop-blur-xs"></div>
    <div class="size-20 shadow-lg bg-white rounded-xl relative" x-cloak x-show="open"
        x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-8 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-8 scale-95">
        <div class="flex items-center justify-center h-full">
            <i class="hgi hgi-stroke hgi-loading-02 animate-spin text-3xl text-zinc-500"></i>
        </div>
    </div>
</div>
