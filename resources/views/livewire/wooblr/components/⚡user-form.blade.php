<div x-data x-show="$wire.isOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" role="dialog"
    x-on:open-modal-form-user.window="$js.callbackModalOpen($event.detail)"
    x-on:close-modal-form-user.window="$js.callbackModalClose()">
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
                'relative w-full max-w-lg bg-white rounded-2xl shadow-2xl ring-1 ring-black/5': $wire
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
                                <h3 class="text-lg font-bold leading-6 text-zinc-900" id="modal-title">Hapus Pengguna?
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-zinc-500">
                                        Apakah Anda yakin ingin menghapus pengguna "<span
                                            class="font-bold text-zinc-800" x-text="$wire.eventTitle"></span>"?
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
                                x-text="$wire.eventName === 'update' ? 'Edit Pengguna' : 'Buat Pengguna Baru'"></h3>
                            <p class="text-xs text-zinc-500 mt-0.5">Atur detail dan peran untuk pengguna ini.</p>
                        </div>
                        <button type="button" wire:click="$js.callbackModalClose()"
                            class="text-zinc-400 size-8 hover:text-zinc-600 p-1 flex items-center justify-center rounded-md hover:bg-zinc-100 transition-colors">
                            <i class="hgi hgi-stroke hgi-cancel-01 text-xl leading-0"></i>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-6 custom-scrollbar bg-zinc-50/50">
                        <form wire:submit="save" id="userForm" class="space-y-5">
                            <x-input type="text" label="Nama Lengkap *" wire:model="name"
                                placeholder="Misal: John Doe..." required />
                            <x-input type="email" label="Alamat Email *" wire:model="email"
                                placeholder="Misal: johndoe@company.com" required />
                            <div>
                                <x-password label="Password" wire:model="password"
                                    placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
                                <template x-if="$wire.eventName === 'update'">
                                    <span class="text-xs mt-1 text-zinc-500">Kosongkan jika tidak ingin mengganti</span>
                                </template>
                            </div>
                            <div>
                                <label class="dark:text-dark-400 mb-2 block text-sm font-medium text-black">Role
                                    Pengguna</label>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach ($roles as $role)
                                        <label
                                            class="relative flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all duration-200
                                    hover:bg-white"
                                            x-bind:class="{
                                                'bg-orange-50/50 border-orange-200 ring-1 ring-orange-200': $wire
                                                    .selectedRoles.includes(
                                                        '{{ $role->name }}'),
                                                'bg-white border-zinc-200': !$wire
                                                    .selectedRoles.includes('{{ $role->name }}')
                                            }">

                                            <input type="checkbox" wire:model="selectedRoles"
                                                value="{{ $role->name }}" class="sr-only">

                                            <div class="size-5 rounded border bg-white flex items-center justify-center transition-colors"
                                                x-bind:class="{
                                                    '!border-orange-500 !bg-orange-500': $wire
                                                        .selectedRoles.includes(
                                                            '{{ $role->name }}'),
                                                    '!border-zinc-300': !$wire
                                                        .selectedRoles.includes('{{ $role->name }}')
                                                }">
                                                <template
                                                    x-if="$wire
                                                    .selectedRoles.includes( '{{ $role->name }}' )"">
                                                    <i class="hgi hgi-stroke hgi-tick-02 text-white text-sm"></i>
                                                </template>
                                            </div>

                                            <div class="text-sm font-medium text-zinc-700 capitalize">
                                                {{ $role->name }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('selectedRoles')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="px-6 py-4 border-t border-zinc-100 bg-white rounded-b-2xl flex justify-end gap-3 z-10">
                        <button type="button" wire:click="$js.callbackModalClose()"
                            class="px-4 py-2 h-[40px] flex items-center justify-center text-sm font-semibold text-zinc-600 hover:bg-zinc-100 rounded-lg transition-colors">
                            Batal
                        </button>
                        <x-button type="submit" form="userForm" loading="save">
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
                $wire.name = null;
                $wire.email = null;
                $wire.password = null;
                $wire.selectedRoles = [];
            }, 200);
        });
    </script>
@endscript
