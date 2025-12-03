<div class="space-y-6">

    <div class="flex justify-between gap-3 items-start md:items-center flex-col md:flex-row">
        <div class="space-y-0.5">
            <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Pengguna</h2>
            <p class="text-sm text-zinc-500 mt-1">Kelola daftar pengguna dan hak akses mereka.</p>
        </div>
        <x-button type="button" wire:click="$js.openModal('open-modal-form-user', {id:null,event:'create'})">
            <i class="hgi hgi-stroke hgi-add-01"></i>
            Tambah Pengguna
        </x-button>
    </div>

    <div class="bg-white border border-zinc-200 rounded-xl shadow-xs overflow-hidden flex flex-col">

        <div class="p-4 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center gap-4">
            <div class="relative w-full max-w-md">
                <x-input wire:model.live.debounce.500ms="search" type="text" placeholder="Cari nama atau email...">
                    <x-slot:prefix>
                        <span class="pl-3"><i class="hgi hgi-stroke hgi-search-01 text-zinc-400 text-lg"></i></span>
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

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-zinc-50/50 border-b border-zinc-100 text-xs uppercase tracking-wider text-zinc-600 font-semibold">
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Peran</th>
                        <th class="px-6 py-4">Bergabung</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($this->records as $user)
                        <tr class="group hover:bg-zinc-50/50">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600 font-bold text-sm ring-1 ring-zinc-200 uppercase">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-zinc-900 text-sm">{{ $user->name }}</div>
                                        <div class="text-xs text-zinc-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($user->roles as $role)
                                        @if ($role->name === 'Owner')
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs font-medium bg-zinc-900 text-zinc-100 border border-zinc-700">
                                                <i class="hgi hgi-stroke hgi-shield-tick text-[10px]"></i>
                                                Owner
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-white text-zinc-600 border border-zinc-200 shadow-xs">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-zinc-500">
                                {{ $user->created_at->format('d M Y') }}
                                <span
                                    class="block text-[10px] text-zinc-400">{{ $user->created_at->diffForHumans() }}</span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-1">
                                    <button
                                        wire:click="$js.openModal('open-modal-form-user', {id:{{ $user->id }},event:'update'})"
                                        class="p-2 size-10 flex items-center justify-center text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 rounded-lg transition-colors"
                                        title="Edit">
                                        <i class="hgi hgi-stroke hgi-pencil-edit-02 text-lg"></i>
                                    </button>

                                    @if (auth('wooblr')->id() !== $user->id)
                                        <button
                                            wire:click="$js.openModal('open-modal-form-user', {id:{{ $user->id }},event:'delete',title: '{{ $user->name }}'})"
                                            class="p-2 size-10 flex items-center justify-center text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Hapus">
                                            <i class="hgi hgi-stroke hgi-delete-02 text-lg"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">

                                <div
                                    class="flex flex-col items-center justify-center max-w-sm mx-auto animate-in fade-in zoom-in duration-300">

                                    <div class="relative mb-6 group">
                                        <div
                                            class="absolute inset-0 bg-zinc-100 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        </div>

                                        <div
                                            class="relative size-20 rounded-2xl bg-zinc-50 border border-zinc-100 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] flex items-center justify-center rotate-3 group-hover:rotate-6 transition-transform duration-300">
                                            <div
                                                class="size-16 rounded-xl bg-white border border-zinc-50 shadow-sm flex items-center justify-center -rotate-3 group-hover:-rotate-6 transition-transform duration-300">
                                                @if (!empty($search))
                                                    <i class="hgi hgi-stroke hgi-search-02 text-3xl text-zinc-400"></i>
                                                @else
                                                    <i class="hgi hgi-stroke hgi-user-group text-3xl text-zinc-300"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if (!empty($search))
                                        <h3 class="text-lg font-bold text-zinc-900 mb-1">
                                            Tidak ditemukan hasil
                                        </h3>
                                        <p class="text-sm text-zinc-500 mb-6 leading-relaxed">
                                            Kami tidak dapat menemukan user dengan kata kunci <span
                                                class="font-semibold text-zinc-800">"{{ $search }}"</span>.
                                            <br>Pastikan penulisan sudah benar.
                                        </p>

                                        <button type="button" wire:click="$set('search', '')"
                                            class="inline-flex items-center h-[40px] gap-2 px-4 py-2 bg-white border border-zinc-200 rounded-lg text-sm font-semibold text-zinc-700 hover:bg-zinc-50 hover:border-zinc-300 hover:text-zinc-900 transition-all shadow-xs active:scale-95">
                                            <i class="hgi hgi-stroke hgi-cancel-circle text-zinc-400"></i>
                                            Hapus Pencarian
                                        </button>
                                    @else
                                        <h3 class="text-lg font-bold text-zinc-900 mb-1">
                                            Belum ada pengguna
                                        </h3>
                                        <p class="text-sm text-zinc-500 mb-6 leading-relaxed">
                                            Database pengguna masih kosong. Mulailah dengan menambahkan pengguna baru ke
                                            sistem.
                                        </p>

                                        <x-button type="button"
                                            wire:click="$js.openModal('open-modal-form-user', {id:null,event:'create'})">
                                            <i class="hgi hgi-stroke hgi-add-01"></i>
                                            Tambah Pengguna
                                        </x-button>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-zinc-50 px-6 py-3 border-t border-zinc-200">
            <x-wooblr.ui.pagination :records="$this->records" />
        </div>
    </div>
</div>

@script
    <script>
        $js('openModal', (elm, params) => {
            $dispatch(elm, params);
        });
    </script>
@endscript
