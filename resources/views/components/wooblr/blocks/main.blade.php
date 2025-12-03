@props([
    'centralized' => false,
])
<div class="flex flex-col gap-4 h-full">
    @if ($title ?? null)
        <div @class([
            'shrink flex items-center gap-4 justify-between flex-wrap',
            'w-full justify-center text-center' => $centralized,
        ])>
            <div class="space-y-0.5">
                <h2 class="text-xl font-semibold">{{ $title ?? '' }}</h2>
                <p class="text-zinc-500">{{ $subtitle ?? '' }}</p>
            </div>
            <div id="header-main" class="w-full md:w-auto"></div>
        </div>
    @endif
    <div class="flex-1">
        {{ $slot }}
    </div>
</div>
