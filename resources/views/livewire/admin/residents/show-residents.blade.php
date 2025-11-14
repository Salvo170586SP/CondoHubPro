<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/residents">Residenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Dettagli Residenti</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/residents">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-5">
            <div
                class="w-[380px] h-full p-5 rounded-lg shadow border bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                <div class="mb-3 flex justify-between">
                    @if ($resident->img_user)
                    <flux:avatar size="xl" src="{{ asset('storage/' . $resident->img_user) }}" />
                    @else
                    <flux:avatar name="{{ $resident->name . ' ' . $resident->surname }}" />
                    @endif
                    <flux:button icon="pencil" variant="filled" wire:navigate
                        href="/admin/residents/{{ $resident->id }}/edit"> Modifica
                    </flux:button>
                </div>
                <div class="space-y-5 my-5  text-gray-900 dark:text-white">
                    <div class="text-sm">
                        <div class="font-medium">Nome e Cognome:</div>
                        {{ $resident->name . ' ' . $resident->surname }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Telefono:</div>
                        {{ $resident->phone_number }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Email:</div>
                        {{ $resident->email }}
                    </div>
                </div>
            </div>

            <div class="w-full p-5 rounded-lg shadow border dark:border-zinc-600 bg-zinc-100/50 dark:bg-zinc-700/50">
                <div>
                    <div class="mb-5">
                        <h2 class="w-full text-lg font-medium">Appartamenti di Residenza</h2>
                        @if($resident->apartments->count() > 0)
                        <small>*Per visualizzare i dati relativi ai condomini se associati, cliccare sulla
                            freccia</small>
                        @endif
                    </div>
                    @if($resident->apartments->count() > 0)
                    <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                        <thead class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                            <tr>
                                <th class="px-6 py-3 text-left tracking-wider">
                                </th>
                                <th class="px-6 py-3 text-left tracking-wider">
                                    Nome
                                </th>
                                <th class="px-6 py-3 text-left tracking-wider">
                                    Piano
                                </th>
                                <th class="px-6 py-3 text-left tracking-wider">
                                    Interno
                                </th>
                                <th class="px-6 py-3 text-left tracking-wider">
                                    Metri quadri
                                </th>
                                <th class="px-6 py-3 text-left tracking-wider">
                                    Vani
                                </th>
                                <th class="px-6 py-3 text-left tracking-wider">
                                    Creato il
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-600" x-data="{ openRow: null }">
                            @foreach($resident->apartments as $apartment)
                            <tr wire:key="apartment-{{ $apartment->id }}-{{ str()->random(10) }}"
                                class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                <td class="px-6 py-4 whitespace-nowrap w-[50px]">
                                    @if ($apartment->condominium && $apartment->condominium->count() > 0)
                                    <flux:button variant="filled" size="sm" icon="chevron-down" title="vedi condominio"
                                        @click="openRow === {{ $apartment->id }} ? openRow = null : openRow = {{ $apartment->id }}">
                                    </flux:button>
                                    @else
                                    <flux:button variant="filled" size="sm" icon="no-symbol" />
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    {{ $apartment->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $apartment->floor }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $apartment->unit_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $apartment->square_metres }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $apartment->rooms }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $apartment->getDate($apartment->created_at) }}
                                </td>
                            </tr>

                            @if($apartment->condominium )
                            <tr x-show="openRow == {{ $apartment->id }}" x-cloak>
                                <td colspan="7" class="p-5">
                                    <h2 class="w-full text-sm font-medium mb-5">Dati Condominio</h2>
                                    <div class="rounded-lg border dark:border-zinc-600">
                                        <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                                            <thead
                                                class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                                                <tr>
                                                    <th class="px-6 py-3 text-left tracking-wider">
                                                        Condominio
                                                    </th>
                                                    <th class="px-6 py-3 text-left tracking-wider">
                                                        Amministratore
                                                    </th>
                                                    <th class="px-6 py-3 text-left tracking-wider">
                                                        Città
                                                    </th>
                                                    <th class="px-6 py-3 text-left tracking-wider">
                                                        Indirizzo
                                                    </th>
                                                    <th class="px-6 py-3 text-left tracking-wider">
                                                        Cap
                                                    </th>
                                                    <th class="px-6 py-3 text-left tracking-wider">
                                                        Creato il
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                                                <tr wire:key="condominiumApp-{{ $apartment->condominium->id }}-{{ str()->random(10) }}"
                                                    class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                                        {{ $apartment->condominium->name }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                                        {{ $apartment->condominium->administrator->getFullName() }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $apartment->condominium->city->name_city }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $apartment->condominium->address }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $apartment->condominium->cap }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{$apartment->condominium->getDate($apartment->condominium->created_at)}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        <p>Nessun appartamento associato.</p>
                        <p class="text-sm mt-2">Vai su Modifica e clicca su "Aggiungi Appartamento" per iniziare.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>