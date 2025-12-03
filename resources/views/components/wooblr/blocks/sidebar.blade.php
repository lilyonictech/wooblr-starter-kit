<aside class="md:w-68 shrink transition-all w-0" x-bind:class="{ 'md:!w-68': sidebarToggle, '!w-0': !sidebarToggle }">
    <div class="fixed bg-white md:bg-transparent z-40 p-3 left-0 top-0 bottom-0 w-72 md:translate-x-0 md:w-68 transition-all -translate-x-full :pr-3"
        x-bind:class="{ '!translate-x-0': sidebarToggle, '!-translate-x-full': !sidebarToggle }">

        <div class="flex flex-col h-full bg-white md:bg-transparent">

            <div class="flex flex-col gap-2 px-2 mb-4">
                <a wire:navigate href="{{ route('wooblr.index') }}"
                    class="flex items-center gap-3 px-2 py-2 rounded-xl transition-colors hover:bg-zinc-50">
                    <div class="size-10 rounded-lg p-1 overflow-hidden shadow-sm border border-zinc-100">
                        <img class="size-full object-cover"
                            src="{{ $globalSettings && $globalSettings->site_logo ? Storage::url($globalSettings->site_logo) : asset('images/logo.png') }}"
                            onerror="this.style.display='none'" />
                        <div class="size-full bg-orange-600 flex items-center justify-center text-white font-bold text-xs"
                            style="display: none" onerror="this.style.display='flex'">AI</div>
                    </div>
                    <div class="flex-1 overflow-hidden ">
                        <h1 class="text-base font-bold text-zinc-900 leading-none pt-[4px]">
                            {{ $globalSettings->site_name ?? config('app.name') }}
                        </h1>
                        <span class="text-[10px] text-zinc-400 font-medium tracking-wide uppercase">Business
                            Suite</span>
                    </div>
                </a>
            </div>

            <div class="flex min-h-0 flex-1 flex-col gap-4 overflow-y-auto overflow-x-hidden custom-scrollbar px-2 pb-4"
                x-ref="sidebarScroll">

                <ul class="flex w-full flex-col gap-1">
                    <li>
                        <a wire:navigate href="{{ route('wooblr.index') }}" @class([
                            'flex items-center gap-3 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors',
                            'bg-orange-50 text-orange-700' => request()->routeIs('wooblr.index'),
                            'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900' => !request()->routeIs(
                                'wooblr.index'),
                        ])>
                            <i class="hgi hgi-stroke hgi-dashboard-square-01 text-lg"></i>
                            Dashboard
                        </a>
                    </li>
                </ul>

                @role('Owner')
                    <div>
                        <div class="px-3 mb-2 text-xs font-bold text-black uppercase tracking-wider">
                            Administrasi
                        </div>
                        <ul class="flex w-full flex-col gap-1">
                            <li>
                                <a wire:navigate href="{{ route('wooblr.user') }}" @class([
                                    'flex items-center gap-3 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors',
                                    'bg-orange-50 text-orange-700' => request()->routeIs('wooblr.user'),
                                    'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900' => !request()->routeIs(
                                        'wooblr.user'),
                                ])>
                                    <i class="hgi hgi-stroke hgi-user-group text-lg"></i>
                                    <span>Pengguna</span>
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('wooblr.roles') }}" @class([
                                    'flex items-center gap-3 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors',
                                    'bg-orange-50 text-orange-700' => request()->routeIs('wooblr.roles'),
                                    'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900' => !request()->routeIs(
                                        'wooblr.roles'),
                                ])>
                                    <i class="hgi hgi-stroke hgi-shield-key text-lg"></i>
                                    <span>Peran & Izin</span>
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('wooblr.setting') }}" @class([
                                    'flex items-center gap-3 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors',
                                    'bg-orange-50 text-orange-700' => request()->routeIs('wooblr.setting'),
                                    'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900' => !request()->routeIs(
                                        'wooblr.setting'),
                                ])>
                                    <i class="hgi hgi-stroke hgi-settings-02 text-lg"></i>
                                    <span>Pengaturan Umum</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endrole


            </div>

            <div class="shrink p-2 space-y-3 mt-auto border-t border-zinc-100 bg-zinc-50/50">

                <div class="relative" x-data="{ open: false }">
                    @php
                        $user = Auth::guard('wooblr')->user();
                    @endphp
                    <button x-ref="buttonAccount" x-on:click="open = ! open" type="button"
                        class="flex items-center p-2 gap-3 rounded-xl text-sm w-full transition-all duration-200"
                        x-bind:class="open
                            ?
                            'bg-white border-zinc-200 shadow-md translate-y-[-2px]' :
                            'bg-transparent border-transparent hover:bg-zinc-200/50 hover:border-zinc-200'">

                        <div
                            class="relative size-9 shrink-0 overflow-hidden rounded-full bg-zinc-200 ring-2 ring-white shadow-sm">
                            <span
                                class="flex size-full items-center justify-center font-bold text-zinc-500 bg-zinc-100">
                                {{ substr($user->name, 0, 1) }}
                            </span>
                        </div>

                        <div class="grid flex-1 text-left leading-tight space-y-0.5">
                            <span class="truncate font-bold text-zinc-800 text-xs">
                                {{ $user->name }}
                            </span>
                            <span class="truncate text-[10px] text-zinc-500 font-medium">
                                {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                            </span>
                        </div>

                        <i class="hgi hgi-stroke hgi-more-vertical text-zinc-400 transition-transform duration-300"
                            x-bind:class="open ? 'rotate-90 text-zinc-800' : ''"></i>
                    </button>

                    <div x-cloak class="absolute bottom-full left-0 w-full mb-2 z-50"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-2 scale-95" x-show="open"
                        x-on:click.outside="open = false">

                        <div
                            class="bg-white p-1.5 shadow-2xl border border-zinc-100 rounded-xl w-full ring-1 ring-black/5">
                            <div class="px-3 py-2 border-b border-zinc-50 mb-1 bg-zinc-50/50 rounded-lg">
                                <p class="text-[10px] uppercase tracking-wider text-zinc-400 font-bold mb-0.5">Signed
                                    in as</p>
                                <p class="text-xs font-semibold text-zinc-900 truncate" title="{{ $user->email }}">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <a wire:navigate href="#"
                                class="w-full flex items-center gap-2 px-3 py-2 text-sm font-medium text-zinc-600 hover:bg-zinc-50 rounded-lg transition-colors group">
                                <i
                                    class="hgi hgi-stroke hgi-user-circle text-base leading-0 group-hover:-translate-x-0.5 transition-transform"></i>
                                Profil Saya
                            </a>

                            <livewire:wooblr.ui.logout />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</aside>
