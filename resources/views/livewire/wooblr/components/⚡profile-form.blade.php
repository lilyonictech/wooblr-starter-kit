<div class="space-y-6">
    <div class="flex justify-between gap-3 items-start md:items-center flex-col md:flex-row">
        <div class="space-y-0.5">
            <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Profil Saya</h2>
            <p class="text-sm text-zinc-500 mt-1">Kelola informasi akun dan keamanan Anda.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-b border-zinc-100 pb-10">
        <div class="md:col-span-1">
            <h3 class="text-lg font-bold text-zinc-900">Informasi Pribadi</h3>
            <p class="text-sm text-zinc-500 mt-1 leading-relaxed">
                Perbarui nama lengkap dan alamat email profil Anda.
            </p>
        </div>

        <div class="md:col-span-2">
            <form wire:submit="updateProfileInformation"
                class="bg-white p-6 rounded-xl border border-zinc-200 shadow-xs relative">

                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="size-16 rounded-full bg-zinc-100 flex items-center justify-center text-xl font-bold text-zinc-600 border border-zinc-200 uppercase">
                        {{ substr($name, 0, 2) }}
                    </div>
                    <div>
                        <div class="text-sm font-bold text-zinc-900">Foto Profil</div>
                        <div class="text-xs text-zinc-500">Foto diambil dari inisial nama Anda.</div>
                    </div>
                </div>

                <div class="space-y-4">
                    <x-input type="text" label="Nama Lengkap *" wire:model="name" placeholder="Misal: John Doe"
                        required />
                    <x-input type="email" label="Email *" wire:model="email" placeholder="Misal: johndoe@company.com"
                        required />
                </div>

                <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-zinc-100">
                    <x-button type="submit" loading="updateProfileInformation">
                        <i class="hgi hgi-stroke hgi-floppy-disk"></i>
                        Simpan Profil
                    </x-button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-b border-zinc-100 pb-10">
        <div class="md:col-span-1">
            <h3 class="text-lg font-bold text-zinc-900">Update Password</h3>
            <p class="text-sm text-zinc-500 mt-1 leading-relaxed">
                Pastikan akun Anda aman dengan menggunakan password yang panjang dan acak.
            </p>
        </div>

        <div class="md:col-span-2">
            <form wire:submit="updatePassword" class="bg-white p-6 rounded-xl border border-zinc-200 shadow-xs">

                <div class="space-y-4">
                    <x-password label="Password Saat Ini *" wire:model="current_password"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required />
                    <x-password label="Password Baru *" wire:model="password"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required />
                    <x-password label="Konfirmasi Password Baru *" wire:model="password_confirmation"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required />
                </div>

                <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-zinc-100">
                    <x-button type="submit" loading="updatePassword">
                        <i class="hgi hgi-stroke hgi-floppy-disk"></i>
                        Ganti Password
                    </x-button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1">
            <h3 class="text-lg font-bold text-red-600">Hapus Akun</h3>
            <p class="text-sm text-zinc-500 mt-1 leading-relaxed">
                Setelah akun Anda dihapus, semua data dan asetnya akan hilang secara permanen.
            </p>
        </div>

        <div class="md:col-span-2">
            <div class="bg-red-50/50 p-6 rounded-xl border border-red-100">
                <div class="text-sm text-red-600 mb-4">
                    Tindakan ini tidak dapat dibatalkan. Ini akan menghapus akun Anda secara permanen dan menghapus data
                    Anda dari server kami.
                </div>
                <x-button type="button" color="red" wire:click="$js.callbackModalOpen({event:'delete'})">
                    Ya, Hapus Akun Saya
                </x-button>
            </div>
        </div>
    </div>

    @teleport('body')
        <div x-data x-show="$wire.isOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" role="dialog"
            x-on:close-modal-form-account.window="$js.callbackModalClose()">
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
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-zinc-100">
                    <div>
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">

                                <div
                                    class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10 ring-1 ring-red-100">
                                    <i class="hgi hgi-stroke hgi-alert-02 text-red-600 text-xl"></i>
                                </div>

                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-lg font-bold leading-6 text-zinc-900" id="modal-title">Apakah Anda
                                        yakin?</h3>
                                    <p class="text-sm text-zinc-500 mb-6">
                                        Masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda
                                        secara permanen.
                                    </p>
                                    <form wire:submit="deleteAccount" id="deleteForm" class="space-y-1">
                                        <x-password label="Password *" wire:model="delete_password"
                                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required />
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-zinc-50/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-zinc-100 gap-2">
                            <x-button type="submit" class="w-full md:w-auto" form="deleteForm" color="red"
                                wire:click="deleteAccount" loading="deleteAccount">
                                <span>Ya, Hapus Akun</span>
                            </x-button>

                            <button type="button" wire:click="$js.callbackModalClose()"
                                class="mt-3 h-[40px] items-center inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-xs ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto transition-colors"
                                wire:loading.attr="disabled" wire:target="deleteAccount">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endteleport
</div>

@script
    <script>
        $js('callbackModalOpen', (params) => {
            $wire.eventName = params.event;
            $wire.isOpen = true;
        });

        $js('callbackModalClose', (params) => {
            $wire.isOpen = false;
            setTimeout(() => {
                $wire.eventName = null;
            }, 200);
        });
    </script>
@endscript
