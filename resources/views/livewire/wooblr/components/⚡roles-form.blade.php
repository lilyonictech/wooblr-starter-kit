<div x-data x-show="$wire.isOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" role="dialog"
    x-on:open-modal-form-roles.window="$js.callbackModalOpen($event.detail)"
    x-on:close-modal-form-roles.window="$js.callbackModalClose()">
    <div x-show="$wire.isOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-zinc-900/40 backdrop-blur-xs" wire:click="$js.callbackModalClose()"></div>

    <div class="flex min-h-screen items-center justify-center p-4">
        <div x-show="$wire.isOpen" x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-8 scale-95"
            x-bind:class="{
                'relative w-full max-w-3xl bg-white rounded-2xl shadow-2xl ring-1 ring-black/5': $wire
                    .eventName === 'create' || $wire.eventName === 'update',
                'relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-zinc-100': $wire
                    .eventName === 'delete'
            }">
            <template x-if="$wire.eventName === 'delete'">
                <div>
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">

                            <div
                                class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10 ring-1 ring-red-100">
                                <i class="hgi hgi-stroke hgi-alert-02 text-red-600 text-xl"></i>
                            </div>

                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 text-zinc-900" id="modal-title">Hapus Role?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-zinc-500">
                                        Apakah Anda yakin ingin menghapus peran "<span class="font-bold text-zinc-800"
                                            x-text="$wire.eventTitle"></span>"?
                                        <br><br>
                                        <span
                                            class="bg-red-50 text-red-700 px-2 py-0.5 rounded text-xs font-medium border border-red-100">
                                            Tindakan ini tidak dapat dibatalkan.
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-zinc-50/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-zinc-100 gap-2">
                        <x-button type="button" class="w-full md:w-auto" color="red" wire:click="delete"
                            loading="delete">
                            <span>Ya, Hapus Peran</span>
                        </x-button>

                        <button type="button" wire:click="$js.callbackModalClose()"
                            class="mt-3 h-[40px] items-center inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-xs ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto transition-colors"
                            wire:loading.attr="disabled" wire:target="delete">
                            Batal
                        </button>
                    </div>
                </div>
            </template>
            <template x-if="$wire.eventName === 'create' || $wire.eventName === 'update'">
                <div class="flex flex-col max-h-[calc(90vh+40px)]">
                    <div
                        class="px-6 py-5 border-b border-zinc-100 flex justify-between items-center bg-white rounded-t-2xl z-10">
                        <div>
                            <h3 class="text-lg font-bold text-zinc-900"
                                x-text="$wire.eventName === 'update' ? 'Edit Peran' : 'Buat Peran Baru'"></h3>
                            <p class="text-xs text-zinc-500 mt-0.5">Atur detail dan izin untuk peran ini.</p>
                        </div>
                        <button type="button" wire:click="$js.callbackModalClose()"
                            class="text-zinc-400 size-8 hover:text-zinc-600 p-1 flex items-center justify-center rounded-md hover:bg-zinc-100 transition-colors">
                            <i class="hgi hgi-stroke hgi-cancel-01 text-xl leading-0"></i>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-6 custom-scrollbar bg-zinc-50/50">
                        <form wire:submit="save" id="roleForm">
                            <div class="mb-6">
                                <x-input type="text" label="Nama Peran *" wire:model="name"
                                    placeholder="Misal: Manager, Editor..." required />
                            </div>
                            <div class="mb-4 flex items-center gap-2">
                                <div class="h-px flex-1 bg-zinc-200"></div>
                                <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">Akses Izin</span>
                                <div class="h-px flex-1 bg-zinc-200"></div>
                            </div>
                            <div>

                                <div
                                    class="mb-4 sticky -top-6 px-2 -mx-2 z-10 bg-zinc-50/50 backdrop-blur-sm pt-2 pb-2">
                                    <div class="relative">
                                        <x-input wire:model.live.debounce.500ms="search" type="text"
                                            placeholder="Cari izin akses (misal: user, edit)...">
                                            <x-slot:prefix>
                                                <span class="pl-3"><i
                                                        class="hgi hgi-stroke hgi-search-01 text-zinc-400 text-lg"></i></span>
                                            </x-slot:prefix>
                                            <x-slot:suffix>
                                                <div class="pr-3">
                                                    <div wire:loading wire:target="search">
                                                        <span
                                                            class="animate-spin text-zinc-400 text-lg inline-flex items-center justify-center">
                                                            <i class="hgi hgi-stroke hgi-loading-02"></i>
                                                        </span>
                                                    </div>
                                                    @if (!empty($search))
                                                        <button wire:loading.remove wire:target="search" type="button"
                                                            wire:click="$set('search', '')"
                                                            class="text-red-400 hover:text-red-600 cursor-pointer transition-colors">
                                                            <i class="hgi hgi-stroke hgi-cancel-circle text-lg"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </x-slot:suffix>
                                        </x-input>
                                    </div>
                                </div>
                                @if ($this->groupedPermissions->isNotEmpty())
                                    <div class="grid grid-permission grid-cols-1 md:grid-cols-2 gap-5 pb-0">
                                        @foreach ($this->groupedPermissions as $groupName => $perms)
                                            <div
                                                class="bg-white rounded-xl border border-zinc-200 overflow-hidden flex flex-col h-full shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow duration-300">

                                                <div
                                                    class="px-4 py-3 bg-zinc-50/50 border-b border-zinc-100 flex items-center justify-between">
                                                    <div class="flex items-center gap-2.5">
                                                        <div
                                                            class="size-7 rounded-lg bg-white border border-zinc-200 text-zinc-600 shadow-xs flex items-center justify-center text-xs font-bold uppercase">
                                                            {{ substr($groupName, 0, 1) }}
                                                        </div>
                                                        <h4
                                                            class="font-bold text-sm text-zinc-800 capitalize tracking-tight">
                                                            {{ $groupName }}</h4>
                                                    </div>
                                                    <span
                                                        class="text-[10px] font-semibold text-zinc-400 bg-white border border-zinc-200 px-1.5 py-0.5 rounded-md shadow-xs">
                                                        {{ count($perms) }}
                                                    </span>
                                                </div>

                                                <div class="p-2 space-y-1 flex-1">
                                                    @foreach ($perms as $perm)
                                                        <div>
                                                            <label
                                                                class="relative flex items-center gap-3 p-2.5 rounded-lg cursor-pointer transition-all duration-200 border group select-none
                        hover:bg-zinc-50
                        has-[:checked]:bg-orange-50/60 has-[:checked]:border-orange-200 has-[:checked]:shadow-xs
                        border-transparent">

                                                                <div class="relative flex items-center">
                                                                    <input type="checkbox"
                                                                        wire:model="selectedPermissions"
                                                                        value="{{ $perm->name }}"
                                                                        class="peer sr-only">
                                                                    <div
                                                                        class="size-5 rounded border-2 border-zinc-300 bg-white transition-all duration-200
                                        peer-checked:bg-orange-600 peer-checked:border-orange-600 peer-checked:scale-110
                                        group-hover:border-zinc-400">
                                                                        <i
                                                                            class="hgi hgi-stroke hgi-tick-02 text-white text-[10px] absolute inset-0 flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                                                    </div>
                                                                </div>

                                                                <div class="flex-1">
                                                                    <div
                                                                        class="text-sm font-medium text-zinc-600 group-hover:text-zinc-900 peer-checked:text-orange-900 transition-colors">
                                                                        {{ $perm->label }}
                                                                    </div>
                                                                </div>

                                                                <div class="hidden peer-checked:block text-orange-600">
                                                                    <span
                                                                        class="size-1.5 rounded-full bg-orange-600 block"></span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center pt-12 pb-18 animate-in">
                                        <div
                                            class="bg-zinc-50 size-16 rounded-full flex items-center justify-center mx-auto mb-3 border border-zinc-100">
                                            <i class="hgi hgi-stroke hgi-search-02 text-zinc-400 text-2xl"></i>
                                        </div>
                                        <p class="text-zinc-900 font-medium">Tidak ditemukan izin.</p>
                                        <p class="text-zinc-500 text-sm">Coba kata kunci lain untuk "<span
                                                class="font-bold">{{ $search }}</span>".</p>

                                        <button type="button" wire:click="$set('search', '')"
                                            class="mt-4 text-xs font-semibold text-orange-600 hover:underline">
                                            Hapus Pencarian
                                        </button>
                                    </div>
                                @endif

                            </div>
                        </form>
                    </div>

                    <div class="px-6 py-4 border-t border-zinc-100 bg-white rounded-b-2xl flex justify-end gap-3 z-10">
                        <button type="button" wire:click="$js.callbackModalClose()"
                            class="px-4 py-2 h-[40px] flex items-center justify-center text-sm font-semibold text-zinc-600 hover:bg-zinc-100 rounded-lg transition-colors">
                            Batal
                        </button>
                        <x-button type="submit" form="roleForm" loading="save">
                            <span>Simpan Perubahan</span>
                        </x-button>
                    </div>
                </div>
            </template>

        </div>
    </div>
</div>

@script
    <script>
        $js('callbackModalOpen', (params) => {
            $wire.eventName = params.event;
            $wire.eventId = params.id;
            $wire.eventTitle = params.title ?? null;
            if (params.event === 'update') {
                $dispatch('open-modal-loading');
                $wire.loadRecord(params.id);
            } else {
                $wire.isOpen = true;
            }
        });

        $js('callbackModalClose', (params) => {
            $wire.isOpen = false;
            setTimeout(() => {
                $wire.eventTitle = null;
                $wire.eventName = null;
                $wire.eventId = null;
                $wire.selectedPermissions = [];
                $wire.name = null;
            }, 200);
        });
    </script>
@endscript
