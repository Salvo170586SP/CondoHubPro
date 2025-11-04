<div>
    <div class="flex items-center justify-between my-3 h-15">

        <div class="w-100">
            <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
        </div>

        @if (count($selected) > 0)
            <div class="bg-zinc-50 w-[350px] flex justify-between items-center shadow rounded-lg p-3">
                <div class="text-zinc-600 font-medium border-e pe-2">
                    <span class="font-bold me-2">{{ count($selected) }}</span> selezionati
                </div>

                <div>
                    <flux:modal.trigger name="delete-profile">
                        <flux:button size="sm" icon="trash" variant="danger">Elimina Selezionati
                        </flux:button>
                    </flux:modal.trigger>

                    <flux:modal name="delete-profile" class="md:w-96">
                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">Attenzione!</flux:heading>
                                <flux:text class="mt-2">Sei sicuoro di eliminare i selezionati?</flux:text>
                            </div>

                            <div class="flex">
                                <flux:spacer />
                                <flux:button wire:click="deleteSelected" variant="danger">Elimina</flux:button>
                            </div>
                        </div>
                    </flux:modal>
                </div>
            </div>
        @endif
    </div>
    @if ($apartments->count() > 0)
        <div class="overflow-x-auto">
            <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                    <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                <flux:checkbox type="checkbox" wire:model.live="areAllSelected"
                                    class="form-checkbox h-4 w-4" />
                            </th>
                            <th class="px-2 py-3 text-left text-xs uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Piano</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Interno</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Stanze</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Metri Quadri</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Residente</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Creato il</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                        @foreach ($apartments as $apartment)
                            <tr wire:key="apartment-{{ $apartment->id }}-{{ str()->random(10) }}"
                                class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <flux:checkbox type="checkbox" wire:model.live="selected"
                                        wire:key="select-{{ $apartment->id }}" value="{{ $apartment->id }}"
                                        class="form-checkbox h-4 w-4" />
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap capitalize">
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
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $apartment->square_metres ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    @if ($apartment->resident)
                                        {{ $apartment->resident->getFullName() }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $apartment->getDate($apartment->created_at) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-end gap-2">
                                        <flux:button icon="pencil" variant="filled" wire:navigate
                                            href="/admin/condominiums/{{ $condominium->id }}/apartments/{{ $apartment->id }}/edit">
                                        </flux:button>
                                        <livewire:admin.apartments.delete-apartments :condominium="$condominium" :apartment="$apartment"
                                            wire:key="apartment-delete-{{ $apartment->id }}-{{ str()->random(10) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-1 mt-5">
                {{ $apartments->links('vendor.livewire.tailwind') }}
            </div>
        </div>
    @else
        <div
            class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
            Non ci sono elementi associati
        </div>
    @endif
</div>
