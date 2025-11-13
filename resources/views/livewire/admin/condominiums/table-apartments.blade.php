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
    @if ($apartments->count() > 0)
    <div class="overflow-x-auto">
        <div class="mb-3">
            {{ $apartments->links('vendor.livewire.tailwind') }}
        </div>
        <div class="min-w-full border dark:border-zinc-600 rounded-lg">
            <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                    <tr>
                        @role('admin|amministratore')
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            <flux:checkbox type="checkbox" wire:model.live="areAllSelected"
                                class="form-checkbox h-4 w-4" />
                        </th>
                        @endrole
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            Nome
                        </th>
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            Piano</th>
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            Interno</th>
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            Stanze</th>
                        @role('admin|amministratore')
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            Metri Quadri</th>
                        @endrole
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            Residente</th>
                        @role('admin|amministratore')
                        <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                        </th>
                        @endrole
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                    @foreach ($apartments as $apartment)
                    <tr wire:key="apartment-{{ $apartment->id }}-{{ str()->random(10) }}"
                        class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                        @role('admin|amministratore')
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <flux:checkbox type="checkbox" wire:model.live="selected"
                                wire:key="select-{{ $apartment->id }}" value="{{ $apartment->id }}"
                                class="form-checkbox h-4 w-4" />
                        </td>
                        @endrole
                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                            {{ $apartment->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap uppercase">
                            {{ $apartment->floor ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($apartment->unit_number)
                            {{ $apartment->unit_number ?? '-' }}
                            @else
                            -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $apartment->rooms ?? '-' }}
                        </td>
                        @role('admin|amministratore')
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $apartment->square_metres ?? '-' }}
                        </td>
                        @endrole
                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                            @if ($apartment->resident)
                            {{ $apartment->resident->getFullName() }}
                            @else
                            -
                            @endif
                        </td>
                        @role('admin|amministratore')
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex justify-end gap-2">
                                <livewire:admin.apartments.delete-apartments :condominium="$condominium"
                                    :apartment="$apartment"
                                    wire:key="apartment-delete-{{ $apartment->id }}-{{ str()->random(10) }}" />
                            </div>
                        </td>
                        @endrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div
        class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
        Non ci sono elementi associati
    </div>
    @endif
</div>