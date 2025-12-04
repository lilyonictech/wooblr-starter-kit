<div class="space-y-6">

    <div class="flex justify-between gap-3 items-start md:items-center flex-col md:flex-row">
        <div class="space-y-0.5">
            <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Pengaturan</h2>
            <p class="text-sm text-zinc-500 mt-1">Konfigurasi umum aplikasi dan branding.</p>
        </div>
        <x-button type="submit" form="settingForm" loading="save">
            <i class="hgi hgi-stroke hgi-floppy-disk"></i>
            Simpan Perubahan
        </x-button>
    </div>

    <form wire:submit="save" id="settingForm" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-b border-zinc-100 pb-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-bold text-zinc-900">Identitas Situs</h3>
                <p class="text-sm text-zinc-500 mt-1 leading-relaxed">
                    Informasi dasar yang akan tampil di header, footer, dan meta title aplikasi Anda.
                </p>
            </div>
            <div class="md:col-span-2 space-y-5">
                <div class="bg-white p-6 rounded-xl border border-zinc-200 shadow-xs">
                    <div class="grid gap-5">
                        <div>
                            <x-input type="text" label="Nama Aplikasi *" wire:model="site_name"
                                placeholder="Misal: My Wooblr" required />
                        </div>

                        <div>
                            <x-textarea label="Deskripsi Singkat" wire:model="site_description"
                                placeholder="Misal: My Wooblr" row="4"
                                hint="Akan digunakan untuk meta description SEO." />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-b border-zinc-100 pb-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-bold text-zinc-900">Branding</h3>
                <p class="text-sm text-zinc-500 mt-1 leading-relaxed">
                    Upload logo resmi dan favicon untuk memperkuat identitas brand Anda.
                </p>
            </div>

            <div class="md:col-span-2 space-y-5">
                <div class="bg-white p-6 rounded-xl border border-zinc-200 shadow-xs">

                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        <div class="shrink-0 relative group">
                            <div
                                class="size-24 rounded-full bg-zinc-50 border-2 border-dashed border-zinc-300 flex items-center justify-center overflow-hidden">
                                @if ($site_logo)
                                    <img src="{{ $site_logo->temporaryUrl() }}" class="size-full object-cover">
                                @elseif($existing_logo)
                                    <img src="{{ Storage::url($existing_logo) }}" class="size-full object-cover">
                                @else
                                    <i class="hgi hgi-stroke hgi-image-01 text-zinc-300 text-3xl"></i>
                                @endif
                            </div>

                            <div wire:loading wire:target="site_logo"
                                class="absolute inset-0 bg-white/80 flex items-center justify-center rounded-full">
                                <i class="hgi hgi-stroke hgi-loading-01 animate-spin text-zinc-800"></i>
                            </div>
                        </div>

                        <div class="flex-1">
                            <label class="block text-sm font-bold text-zinc-700 mb-1">Logo Utama</label>
                            <div class="text-xs text-zinc-500 mb-3">Format JPG, PNG, atau WEBP. Maksimal 1MB.</div>

                            <div class="flex items-center gap-3">
                                <label for="logo-upload"
                                    class="cursor-pointer h-[40px] flex items-center justify-center bg-white border border-zinc-300 text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                                    <span>Pilih File</span>
                                    <input type="file" id="logo-upload" wire:model="site_logo" class="hidden"
                                        accept="image/*">
                                </label>

                                {{-- @if ($existing_logo && !$site_logo)
                                    <button type="button" wire:confirm="Hapus logo saat ini?" wire:click="removeLogo"
                                        class="text-red-500 hover:text-red-700 text-sm font-medium px-2">
                                        Hapus
                                    </button>
                                @endif --}}
                            </div>
                            @error('site_logo')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="h-px bg-zinc-100 my-6"></div>

                    <div class="flex items-center gap-4">
                        <div
                            class="size-12 rounded-lg bg-zinc-50 border border-zinc-200 flex items-center justify-center overflow-hidden shrink-0">
                            @if ($site_favicon)
                                <img src="{{ $site_favicon->temporaryUrl() }}" class="size-full object-cover">
                            @elseif($existing_favicon)
                                <img src="{{ Storage::url($existing_favicon) }}" class="size-full object-cover">
                            @else
                                <i class="hgi hgi-stroke hgi-globe-02 text-zinc-400"></i>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-1">Favicon</label>
                            <div class="flex items-center gap-2">
                                <label for="favicon-upload"
                                    class="cursor-pointer text-orange-600 hover:text-orange-700 text-sm font-medium hover:underline">
                                    Upload file baru
                                    <input type="file" id="favicon-upload" wire:model="site_favicon" class="hidden"
                                        accept="image/*">
                                </label>
                            </div>
                            @error('site_favicon')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-4">
            <div class="md:col-span-1">
                <h3 class="text-lg font-bold text-zinc-900">Kontak Admin</h3>
                <p class="text-sm text-zinc-500 mt-1 leading-relaxed">
                    Email ini akan digunakan untuk notifikasi sistem (outgoing mail).
                </p>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white p-6 rounded-xl border border-zinc-200 shadow-xs">
                    <x-input type="email" label="Email Administrator" placeholder="Misal: wooblr@company.com"
                        wire:model="contact_email">
                        <x-slot:prefix>
                            <span class="px-3 ">
                                <i class="hgi hgi-stroke hgi-mail-01 text-zinc-400 text-lg"></i>
                            </span>
                        </x-slot:prefix>
                    </x-input>
                </div>
            </div>
        </div>
    </form>

</div>
