<div>
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Condomini</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="w-full flex justify-between items-center">
            <h2 class="w-full text-xl font-medium">Condomini</h2>
            @role('admin|amministratore')
            <flux:button icon="plus" variant="filled" wire:navigate href="/admin/condominiums/create">
                Crea
            </flux:button>
            @endrole
        </div>

        <div class="flex justify-between items-center my-3 h-15 ">
            <div class="flex space-x-3">
                <div class="w-100">
                    <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
                </div>

                <div class="flex items-center space-x-3">
                    <flux:select wire:model.live="search_city" id="city" placeholder="cerca per città">
                        <flux:select.option value="">Mostra Tutti</flux:select.option>
                        @foreach ($cities as $city)
                        <flux:select.option value="{{ $city->id }}" wire:key="{{ $city->id }}">
                            {{ $city->name_city }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
            </div>

            @role('admin|amministratore')
            @if (count($selected) > 0)
            <x-modal-select :selected="$selected" />
            @endif
            @endrole
        </div>

        <div class="mb-3">
            {{ $condominiums->links('vendor.livewire.tailwind') }}
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                    <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                        <tr>
                            @role('admin|amministratore')
                            @if ($condominiums->count() > 0)
                            <th class="px-4 py-3 text-left text-xs tracking-wider">
                                <flux:checkbox type="checkbox" wire:model.live="areAllSelected"
                                    class="form-checkbox h-4 w-4" />
                            </th>
                            @endif
                            @endrole
                            <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                                Nome</th>
                            <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                                Indirizzo</th>
                            <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                                Cap</th>
                            <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                                Città</th>
                            <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                                Amministratore</th>
                            @role('admin|amministratore')
                            <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                                Creato il</th>
                            @endrole
                            <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                        @forelse ($condominiums as $condominium)
                        <tr wire:key="condominium-{{ $condominium->id }}-{{ str()->random(10) }}"
                            class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                            @role('admin|amministratore')
                            <td class="px-4 py-4 whitespace-nowrap text-sm">
                                <flux:checkbox type="checkbox" wire:model.live="selected"
                                    wire:key="select-{{ $condominium->id }}" value="{{ $condominium->id }}"
                                    class="form-checkbox h-4 w-4" />
                            </td>
                            @endrole
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                {{ $condominium->name }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                {{ $condominium->address }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $condominium->cap }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                {{ $condominium->city->name_city }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                @if ($condominium->administrator)
                                {{ $condominium->administrator->getFullName() }}
                                @else
                                -
                                @endif
                            </td>
                            @role('admin|amministratore')
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $condominium->getDate($condominium->created_at) }}
                            </td>
                            @endrole
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex justify-end gap-2">
                                    <flux:button icon="eye" size="sm" variant="filled" wire:navigate
                                        href="/admin/condominiums/{{ $condominium->id }}/show">Dettagli
                                    </flux:button>
                                    @role('admin|amministratore')
                                    <flux:button icon="pencil" size="sm" variant="filled" wire:navigate
                                        href="/admin/condominiums/{{ $condominium->id }}/edit">Modifica
                                    </flux:button>
                                    <livewire:admin.condominiums.delete-condominium :condominium="$condominium"
                                        wire:key="condominium-delete-{{ $condominium->id }}-{{ str()->random(10) }}" />
                                    @endrole
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"
                                class="px-4 py-5 text-center text-sm italic bg-zinc-50 text-gray-400 dark:text-gray-400 font-medium">
                                Nessun condominio registrato
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>