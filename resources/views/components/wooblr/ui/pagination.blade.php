@props([
    'records' => [],
    'page_name' => 'page',
])

<div class="flex items-center justify-between gap-4 pt-0 flex-col md:flex-row">
    <div class="font-semibold min-h-8 flex items-center">Total: {{ $records?->total() }}</div>
    @if ($records?->total() > 0)
        <div class="flex items-center space-x-2  text-sm justify-center">
            <button aria-label="Prev" wire:click="gotoPage({{ $records->currentPage() - 1 }}, '{{ $page_name }}')"
                @disabled($records->currentPage() <= 1)
                class="size-8 rounded-full border border-zinc-300 hover:bg-zinc-50 disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center justify-center">
                <i class="hgi hgi-stroke hgi-arrow-left-01 text-xl"></i>
            </button>

            {{-- Page Numbers --}}
            @for ($i = 1; $i <= $records->lastPage(); $i++)
                @if ($i <= 6 || $i == $records->lastPage() || ($i >= $records->currentPage() - 1 && $i <= $records->currentPage() + 1))
                    <button wire:click="gotoPage({{ $i }}, '{{ $page_name }}')"
                        @disabled($records->currentPage() == $i)
                        class="size-8 rounded-full inline-flex items-center justify-center
                {{ $i == $records->currentPage() ? 'bg-primary-600 text-white' : 'border border-zinc-300 hover:bg-zinc-50' }}">
                        {{ $i }}
                    </button>
                @elseif ($i == 7 && $records->currentPage() > 8)
                    <span class="px-2">...</span>
                @elseif ($i == $records->lastPage() - 1 && $records->currentPage() < $records->lastPage() - 7)
                    <span class="px-2">...</span>
                @endif
            @endfor
            <button wire:click="gotoPage({{ $records->currentPage() + 1 }}, '{{ $page_name }}')"
                class="size-8 rounded-full border border-zinc-300 hover:bg-zinc-50 disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center justify-center"
                @disabled($records->currentPage() >= $records->lastPage())>
                <i class="hgi hgi-stroke hgi-arrow-right-01 text-xl"></i>
            </button>
        </div>
    @endif
</div>
