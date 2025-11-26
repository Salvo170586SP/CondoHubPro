<div>
    <div class="container mx-auto relative h-full">
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
                    <flux:avatar name="{{ $resident->getFullName() }}" />
                    @endif
                    <flux:button icon="pencil" variant="filled" wire:navigate
                        href="/admin/residents/{{ $resident->id }}/edit"> Modifica
                    </flux:button>
                </div>
                <div class="space-y-5 my-5  text-gray-900 dark:text-white">
                    <div class="text-sm">
                        <div class="font-medium">Nome e Cognome:</div>
                        {{ $resident->getFullName() }}
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

            <div class="w-full flex-col space-y-3">

                <div
                    class="w-full p-5 rounded-lg shadow border dark:border-zinc-600 bg-zinc-100/50 dark:bg-zinc-700/50">
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
                            <thead
                                class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                                <tr>
                                    <th class="px-4 py-3 text-left tracking-wider uppercase">
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider uppercase">
                                        Nome
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider uppercase">
                                        Piano
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider uppercase">
                                        Interno
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider uppercase">
                                        Metri quadri
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider uppercase">
                                        Vani
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider uppercase">
                                        Creato il
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-600" x-data="{ openRow: null }">
                                @foreach($resident->apartments as $apartment)
                                <tr wire:key="apartment-{{ $apartment->id }}-{{ str()->random(10) }}"
                                    class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                    <td class="px-4 py-4 whitespace-nowrap w-[50px]">
                                        @if ($apartment->condominium && $apartment->condominium->count() > 0)
                                        <flux:button variant="filled" size="sm" icon="chevron-down"
                                            title="vedi condominio"
                                            @click="openRow === {{ $apartment->id }} ? openRow = null : openRow = {{ $apartment->id }}">
                                        </flux:button>
                                        @else
                                        <flux:button variant="filled" size="sm" icon="no-symbol" />
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap capitalize">
                                        {{ $apartment->name }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ $apartment->floor }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ $apartment->unit_number }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ $apartment->square_metres }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ $apartment->rooms }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ $apartment->getDate($apartment->created_at) }}
                                    </td>
                                </tr>

                                @if($apartment->condominium )
                                <tr x-show="openRow == {{ $apartment->id }}" x-cloak>
                                    <td colspan="7" class="p-5">
                                        <h2 class="w-full text-sm font-medium mb-5">Dati Condominio</h2>
                                        <div class="rounded-lg border dark:border-zinc-600">
                                            <table
                                                class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                                                <thead
                                                    class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                                                    <tr>
                                                        <th class="px-4 py-3 text-left tracking-wider uppercase">
                                                            Condominio
                                                        </th>
                                                        <th class="px-4 py-3 text-left tracking-wider uppercase">
                                                            Amministratore
                                                        </th>
                                                        <th class="px-4 py-3 text-left tracking-wider uppercase">
                                                            Città
                                                        </th>
                                                        <th class="px-4 py-3 text-left tracking-wider uppercase">
                                                            Indirizzo
                                                        </th>
                                                        <th class="px-4 py-3 text-left tracking-wider uppercase">
                                                            Cap
                                                        </th>
                                                        <th class="px-4 py-3 text-left tracking-wider uppercase">
                                                            Creato il
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                                                    <tr wire:key="condominiumApp-{{ $apartment->condominium->id }}-{{ str()->random(10) }}"
                                                        class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                                        <td class="px-4 py-4 whitespace-nowrap capitalize">
                                                            {{ $apartment->condominium->name }}
                                                        </td>
                                                        <td class="px-4 py-4 whitespace-nowrap capitalize">
                                                            {{$apartment->condominium &&
                                                            $apartment->condominium->administrator ?
                                                            $apartment->condominium->administrator->getFullName() :
                                                            '-'}}
                                                        </td>
                                                        <td class="px-4 py-4 whitespace-nowrap">
                                                            {{$apartment->condominium && $apartment->condominium->city ?
                                                            $apartment->condominium->city->name_city : '-'}}
                                                        </td>
                                                        <td class="px-4 py-4 whitespace-nowrap">
                                                            {{ $apartment->condominium->address }}
                                                        </td>
                                                        <td class="px-4 py-4 whitespace-nowrap">
                                                            {{ $apartment->condominium->cap }}
                                                        </td>
                                                        <td class="px-4 py-4 whitespace-nowrap">
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
                            <p class="text-sm mt-2">Vai su Modifica e clicca su "Aggiungi Appartamento" per iniziare.
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <div
                    class="w-full p-5 rounded-lg shadow border dark:border-zinc-600 bg-zinc-100 dark:bg-zinc-700/50">
                    <div>
                        <div class="mb-5">
                            <h2 class="w-full text-lg font-medium">Quote Condominiali</h2>
                        </div>
                        <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                            <thead
                                class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                                <tr>
                                    <th class="px-4 py-3 text-left tracking-wider">
                                        Condominio
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider">
                                        Quota
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider">
                                        Note
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider">
                                        Fattura
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider">
                                        Data
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider">
                                        Pagato
                                    </th>
                                    <th class="px-4 py-3 text-left tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                                @forelse($resident->payments as $payment)
                                <tr wire:key="payment-{{ $payment->id }}-{{ str()->random(10) }}"
                                    class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                    <td class="px-4 py-4 whitespace-nowrap capitalize">
                                        {{ $payment->resident->apartment->condominium->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap font-bold">
                                        € {{ $payment->price }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <x-modal-note :item="$payment" />
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if($payment->url_file)
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Emessa</span>
                                        @else
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Non
                                            Presente</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $payment->getDate($payment->date) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($payment->is_pay)
                                        <span
                                            class="px-2 py-1 text-xs rounded-full font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Pagato</span>
                                        @else
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Non
                                            Pagato</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-end">
                                            <flux:button icon="eye" size="sm" variant="filled" wire:navigate
                                                href="/admin/payments/{{ $payment->id }}/show">Dettagli
                                            </flux:button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8"
                                        class="px-4 py-5 text-center text-sm italic bg-zinc-50 text-gray-400 dark:text-gray-400 font-medium">
                                        Nessun pagamento registrato
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>