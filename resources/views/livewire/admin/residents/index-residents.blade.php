<div>
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Residenti</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="w-full flex justify-between items-center">
            <h2 class="w-full text-xl font-medium">Residenti</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/admin/residents/create">
                Crea
            </flux:button>
        </div>

        <div class="flex items-center justify-between my-3 h-15">
            <div class="w-100">
                <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
            </div>

            @if (count($selected) > 0)
            <x-modal-select :selected="$selected" />
            @endif
        </div>

        <div class="my-3">
            {{ $residents->links('vendor.livewire.tailwind') }}
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                    <thead class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs tracking-wider">
                                <flux:checkbox type="checkbox" wire:model.live="areAllSelected"
                                    class="form-checkbox h-4 w-4" />
                            </th>
                            <th class="px-2 py-3 text-left tracking-wider uppercase">
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Nome
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Telefono
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Email
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Creato il</th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                        @forelse ($residents as $resident)
                        <tr wire:key="resident-{{ $resident->id }}-{{ str()->random(10) }}"
                            class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                            <td class="px-4 py-4 whitespace-nowrap text-sm">
                                <flux:checkbox type="checkbox" wire:model.live="selected"
                                    wire:key="select-{{ $resident->id }}" value="{{ $resident->id }}"
                                    class="form-checkbox h-4 w-4" />
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm">
                                @if ($resident->img_user)
                                <flux:avatar src="{{ asset('storage/' . $resident->img_user) }}" />
                                @else
                                <flux:avatar name="{{ $resident->getFullName() }}" />
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                {{ $resident->name . ' ' . $resident->surname }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $resident->phone_number }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $resident->email }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $resident->getDate($resident->created_at) }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex justify-end gap-2">
                                    <flux:button icon="eye" size="sm" variant="filled" wire:navigate
                                        href="/admin/residents/{{ $resident->id }}/show">Dettagli
                                    </flux:button>
                                    <flux:button icon="pencil" size="sm" variant="filled" wire:navigate
                                        href="/admin/residents/{{ $resident->id }}/edit">Modifica
                                    </flux:button>
                                    <livewire:admin.residents.delete-residents :resident="$resident"
                                        wire:key="resident-delete-{{ $resident->id }}-{{ str()->random(10) }}" />
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"
                                class="px-4 py-5 text-center text-sm italic bg-zinc-50 text-gray-400 dark:text-gray-400 font-medium">
                                Nessun residente registrato
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>