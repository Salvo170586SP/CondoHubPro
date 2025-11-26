<div>
    <div class="flex items-center justify-between my-3 h-15">

        <div class="w-100">
            <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
        </div>

        @role('admin|amministratore')
        @if (count($selected) > 0)
        <x-modal-select :selected="$selected" />
        @endif
        @endrole
    </div>

    <div class="mb-3">
        {{ $apartments->links('vendor.livewire.tailwind') }}
    </div>
    <div class="overflow-x-auto">
        <div class="min-w-full border dark:border-zinc-600 rounded-lg">
            <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                    <tr>
                        @role('admin|amministratore')
                        @if($apartments->count())
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            <flux:checkbox type="checkbox" wire:model.live="areAllSelected"
                                class="form-checkbox h-4 w-4" />
                        </th>
                        @endif
                        @endrole
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Nome
                        </th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Piano</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Interno</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Stanze</th>
                        @role('admin|amministratore')
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Metri Quadri</th>
                        @endrole
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Residente</th>
                        @role('admin|amministratore')
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                        </th>
                        @endrole
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                    @forelse ($apartments as $apartment)
                    <tr wire:key="apartment-{{ $apartment->id }}-{{ str()->random(10) }}"
                        class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                        @role('admin|amministratore')
                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                            <flux:checkbox type="checkbox" wire:model.live="selected"
                                wire:key="select-{{ $apartment->id }}" value="{{ $apartment->id }}"
                                class="form-checkbox h-4 w-4" />
                        </td>
                        @endrole
                        <td class="px-4 py-4 whitespace-nowrap capitalize">
                            {{ $apartment->name ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap uppercase">
                            {{ $apartment->floor ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if ($apartment->unit_number)
                            {{ $apartment->unit_number ?? '-' }}
                            @else
                            -
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $apartment->rooms ?? '-' }}
                        </td>
                        @role('admin|amministratore')
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $apartment->square_metres ?? '-' }}
                        </td>
                        @endrole
                        <td class="px-4 py-4 whitespace-nowrap capitalize">
                            @if ($apartment->resident)
                            {{ $apartment->resident->getFullName() }}
                            @else
                            -
                            @endif
                        </td>
                        @role('admin|amministratore')
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex justify-end gap-2">
                                <livewire:admin.apartments.delete-apartments :condominium="$condominium"
                                    :apartment="$apartment"
                                    wire:key="apartment-delete-{{ $apartment->id }}-{{ str()->random(10) }}" />
                            </div>
                        </td>
                        @endrole
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8"
                            class="px-4 py-5 text-center text-sm italic bg-zinc-50 text-gray-400 dark:text-gray-400 font-medium">
                            Nessun appartamento registrato per questo condominio
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>