<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Condomini</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
                <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
                <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Condomini</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/admin/condominiums/create">
                Crea
            </flux:button>
        </div>
        <div class="flex space-x-3 my-3">
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

        @if ($condominiums->count() > 0)
            <div class="overflow-x-auto">
                <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                        <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Nome</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Indirizzo</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Cap</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Città</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Amministratore</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Creato il</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                            @foreach ($condominiums as $condominium)
                                <tr wire:key="condominium-{{ $condominium->id }}-{{ str()->random(10) }}"
                                    class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $condominium->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $condominium->address }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $condominium->cap }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $condominium->city->name_city }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        @if ($condominium->administrator)
                                            {{ $condominium->administrator->getFullName() }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $condominium->getDate($condominium->created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-end gap-2">
                                            <flux:button icon="eye" variant="filled" wire:navigate
                                                href="/admin/condominiums/{{ $condominium->id }}/show">
                                            </flux:button>
                                            <flux:button icon="pencil" variant="filled" wire:navigate
                                                href="/admin/condominiums/{{ $condominium->id }}/edit">
                                            </flux:button>
                                            <livewire:admin.condominiums.delete-condominium :condominium="$condominium"
                                                wire:key="condominium-delete-{{ $condominium->id }}-{{ str()->random(10) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mx-1 mt-5">
                    {{ $condominiums->links('vendor.livewire.tailwind') }}
                </div>
            </div>
        @else
            <div
                class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
                Non ci sono elementi</div>
        @endif
    </div>
</div>
