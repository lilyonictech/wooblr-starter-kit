@props(['items' => []])

<ol class="flex items-center gap-2 text-sm text-zinc-500">
    <li>
        <a wire:navigate href="{{ route('platform.index') }}"
            class="flex items-center hover:text-zinc-800 transition-colors">
            <i class="hgi hgi-stroke hgi-home-01 text-lg"></i>
        </a>
    </li>

    @foreach ($items as $label => $link)
        <li class="flex items-center gap-2">
            <i class="hgi hgi-stroke hgi-arrow-right-01 text-zinc-300 text-xs"></i>

            @if (!$loop->last)
                <a wire:navigate href="{{ $link }}" class="hover:text-zinc-800 hover:underline transition-colors">
                    {{ $label }}
                </a>
            @else
                <span class="font-semibold text-zinc-900 bg-zinc-100 px-2 py-0.5 rounded-md">
                    {{ $label }}
                </span>
            @endif
        </li>
    @endforeach
</ol>
