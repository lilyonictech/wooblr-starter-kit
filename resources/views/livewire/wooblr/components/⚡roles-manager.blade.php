<div class="space-y-6">

    <div class="flex justify-between gap-3 items-start md:items-center flex-col md:flex-row">
        <div class="space-y-0.5">
            <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Peran & Akses</h2>
            <p class="text-sm text-zinc-500 mt-1">Kelola struktur organisasi dan batasan akses pengguna.</p>
        </div>
        <x-button type="button" wire:click="$js.openModal('open-modal-form-roles', {id:null,event:'create'})">
            <i class="hgi hgi-stroke hgi-add-01"></i>
            Tambah Peran
        </x-button>
    </div>

    <div class="bg-white border border-zinc-200 rounded-xl shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-zinc-50/50 border-b border-zinc-100 text-xs uppercase tracking-wider text-zinc-600 font-semibold">
                        <th class="px-6 py-4 min-w-38">Peran Name</th>
                        <th class="px-6 py-4 min-w-38">Pengguna Aktif</th>
                        <th class="px-6 py-4 min-w-42">Izin Akses</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @foreach ($this->records as $role)
                        <tr class="group hover:bg-zinc-50/50 transition-colors duration-200">

                            <td class="px-6 py-4 align-top">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-500 ring-1 ring-zinc-200">
                                        <i class="hgi hgi-stroke hgi-shield-key text-xl leading-0"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-zinc-900 text-sm">{{ ucfirst($role->name) }}</div>
                                        <div class="text-xs text-zinc-400 font-medium">ID: {{ $role->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 align-middle">
                                <div class="flex items-center -space-x-2 overflow-hidden">
                                    @forelse($role->users as $user)
                                        <div class="relative size-8 rounded-full ring-2 ring-white bg-zinc-200 inline-flex items-center justify-center text-xs font-bold text-zinc-600"
                                            title="{{ $user->name }}">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @empty
                                        <span class="text-xs text-zinc-400 italic">Belum ada user</span>
                                    @endforelse

                                    @if ($role->users_count > 4)
                                        <div
                                            class="relative inline-block size-8 rounded-full ring-2 ring-white bg-zinc-100 flex items-center justify-center text-[10px] font-bold text-zinc-500">
                                            +{{ $role->users_count - 4 }}
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 align-middle">
                                @if ($role->name === 'Owner')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-700 border border-purple-100">
                                        <span class="size-1.5 rounded-full bg-purple-500"></span>
                                        Super Access
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-zinc-100 text-zinc-600 border border-zinc-200">
                                        <span class="size-1.5 rounded-full bg-zinc-400"></span>
                                        {{ $role->permissions_count }} Permission
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right align-middle">
                                <div class="flex justify-end gap-1">
                                    <button
                                        wire:click="$js.openModal('open-modal-form-roles', {id:{{ $role->id }},event:'update'})"
                                        class="p-2 size-10 text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 rounded-lg transition-colors"
                                        title="Edit Peran">
                                        <i class="hgi hgi-stroke hgi-pencil-edit-02 text-lg"></i>
                                    </button>

                                    @if ($role->name !== 'Owner')
                                        <button
                                            wire:click="$js.openModal('open-modal-form-roles', {id:{{ $role->id }},event:'delete',title: '{{ $role->name }}'})"
                                            class="p-2 size-10 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Hapus Peran">
                                            <i class="hgi hgi-stroke hgi-delete-02 text-lg"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-zinc-50 px-6 py-4 border-t border-zinc-200 text-xs text-zinc-500 flex justify-between">
            <span>Menampilkan {{ count($this->records) }} peran</span>
            <span>Update terakhir: Sekarang</span>
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
