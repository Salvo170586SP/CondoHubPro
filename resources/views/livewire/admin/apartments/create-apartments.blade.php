<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{ $condominium->id }}/show">Dettagli
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Aggiungi Appartamento</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Aggiungi Appartamento</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate
                href="/admin/condominiums/{{ $condominium->id }}/show">
                Torna Indietro
            </flux:button>
        </div>

        <div class="overflow-x-auto">
            <div class="w-full border dark:border-zinc-600 rounded-lg p-5 space-y-3 bg-zinc-100/50 dark:bg-zinc-700/50">
                <div>
                    @error(session('selectedApartment'))
                    <div
                        class="bg-red-50 border border-red-500 text-red-500 font-medium text-sm my-2 px-3 py-2 rounded-lg">
                        {{ $message }}</div>
                    @enderror

                    @if ($apartments->count() > 0)
                    <div class="overflow-x-auto">
                        <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                            <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                                <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Aggiungi
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Appartamento
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Residente
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Metri quadri
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Vani
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Piano
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Interno
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                            Creato il
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                                    @foreach ($apartments as $apartment)
                                    <tr wire:key="apartment-{{ $apartment->id }}-{{ str()->random(10) }}"
                                        class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <flux:checkbox wire:model="selectedApartment"
                                                value="{{ $apartment->id }}" />
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $apartment->name }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-smuppercase">
                                            @if($apartment->resident)
                                            {{ $apartment->resident->getFullName() }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $apartment->square_metres }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $apartment->rooms }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $apartment->floor }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $apartment->unit_number }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            {{ $apartment->getDate($apartment->created_at) }}
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
                        class="w-full text-center font-medium text-sm dark:text-white dark:bg-zinc-500/40 text-zinc-500 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
                        Non ci sono appartamenti liberi disponibili</div>
                    @endif
                </div>
                @if($apartments->count() > 0 )
                <div class="flex justify-end mt-10">
                    <flux:button icon="check" variant="filled" wire:click="submit">
                        Crea
                    </flux:button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>