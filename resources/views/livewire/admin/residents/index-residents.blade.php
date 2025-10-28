<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Residenti</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
                <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
                <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Residenti</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/admin/residents/create">
                Crea
            </flux:button>
        </div>
        <div class="w-100 my-3">
            <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
        </div>
        @if ($residents->count() > 0)
            <div class="overflow-x-auto">
                <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                        <thead class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                            <tr>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">
                                    Nome e Cognome
                                </th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">
                                    Telefono
                                </th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">
                                    Email
                                </th>

                                <th class="px-6 py-3 text-left uppercase tracking-wider">
                                    Condominio di Residenza
                                </th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">
                                    Appartamento
                                </th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">
                                    Creato il</th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                            @foreach ($residents as $resident)
                                <tr wire:key="resident-{{ $resident->id }}-{{ str()->random(10) }}"
                                    class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $resident->name . ' ' . $resident->surname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $resident->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $resident->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        @isset($resident->apartment->condominium)
                                            {{ $resident->apartment->condominium->name }}
                                        @else
                                            -
                                        @endisset
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        @isset($resident->apartment->condominium)
                                            {{ $resident->apartment->name }}
                                        @else
                                            -
                                        @endisset
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $resident->getDate($resident->created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-end gap-2">
                                            <flux:button icon="eye" variant="filled" wire:navigate
                                                href="/admin/residents/{{ $resident->id }}/show">
                                            </flux:button>
                                            <flux:button icon="pencil" variant="filled" wire:navigate
                                                href="/admin/residents/{{ $resident->id }}/edit">
                                            </flux:button>
                                            <livewire:admin.residents.delete-residents :resident="$resident"
                                                wire:key="resident-delete-{{ $resident->id }}-{{ str()->random(10) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mx-1 mt-5">
                    {{ $residents->links('vendor.livewire.tailwind') }}
                </div>
            </div>
        @else
            <div
                class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
                Non ci sono elementi</div>
        @endif
    </div>
</div>
