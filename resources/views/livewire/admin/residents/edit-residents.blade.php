<div>
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/residents">Residenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Modifica</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Modifica Residente</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/residents">
                Torna Indietro
            </flux:button>
        </div>

        <div class="overflow-x-auto"> 
            <div
                class="min-w-full border dark:border-zinc-600 rounded-lg p-5 space-y-5 bg-zinc-100/50 dark:bg-zinc-700/50">
                <x-input-file-img model="img_user" existingImage="{{ $resident->img_user ? asset('/storage/'. $resident->img_user) : '' }}" text="Allega Foto" />
                <div class="border-b dark:border-zinc-600 pb-5 space-y-5">
                    <div class="grid grid-cols-2 gap-3">
                        <flux:input wire:model="name" label="Nome" />
                        <flux:input wire:model="surname" label="Cognome" />
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <flux:input wire:model="phone_number" label="Telefono" />
                    </div>
                </div>

                {{-- dati catastali --}}
                <div class="w-full">
                    <h2 class="dark:text-zinc-200 font-medium mb-5">Dati Catastali</h2>

                    <div class="w-full flex justify-between items-center gap-3">
                        <div class="font-medium text-sm">
                            Appartamenti aggiunti
                            <span
                                class="inline-flex justify-center items-center ms-2 w-5 h-5 bg-zinc-600 text-white rounded-full">{{count($newApartment)}}</span>
                        </div>
                        <flux:button icon="plus-circle" variant="filled" wire:click="addApartment"
                            class="cursor-pointer">
                            Aggiungi Appartamento
                        </flux:button>
                    </div>

                    {{-- Lista Appartamenti --}}
                    @if(count($newApartment) > 0)
                    <div
                        class="h-[330px] border bg-white dark:bg-zinc-800 dark:border-zinc-500 p-5 mt-3 rounded-lg overflow-y-auto">
                        @foreach($newApartment as $index => $apartment)
                        <div wire:key="apartment-{{ $index }}-{{ $apartment['id'] ?? 'new' }}"
                            class="w-full border dark:border-zinc-600  rounded-lg p-5 my-3 space-y-5 bg-white dark:bg-zinc-700/50 border-zinc-300">

                            <div class="flex items-center justify-between">
                                <flux:button icon="minus-circle" size="sm" variant="danger" class="cursor-pointer"
                                    wire:click="closeNewApartment({{ $index }})"
                                    wire:confirm="Sei sicuro di voler eliminare questo appartamento?">
                                    Elimina Appartamento
                                </flux:button>
                                <div
                                    class="bg-black text-white rounded-full w-8 h-8 font-bold flex justify-center items-center">
                                    {{ $index + 1 }}
                                </div>
                            </div>


                            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-3">
                                <flux:input wire:model="newApartment.{{ $index }}.name_apartment"
                                    label="Nome Appartamento" placeholder="es. Appartamento A" />
                                <flux:input wire:model="newApartment.{{ $index }}.floor" label="Piano"
                                    placeholder="es. 2" />
                                <flux:input wire:model="newApartment.{{ $index }}.unit_number" label="Interno"
                                    placeholder="es. 5" />
                            </div>

                            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3">
                                <flux:input type="number" wire:model="newApartment.{{ $index }}.rooms"
                                    label="Numero Vani" placeholder="es. 4" />
                                <flux:input type="number" step="0.01"
                                    wire:model="newApartment.{{ $index }}.square_metres" label="Metri Quadri"
                                    placeholder="es. 85.5" />
                            </div>

                            {{-- Indicatore appartamento esistente o nuovo --}}
                            @if(isset($apartment['id']) && $apartment['id'])
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 italic">
                                Appartamento esistente (ID: {{ $apartment['id'] }})
                            </p>
                            @else
                            <p class="text-xs text-green-600 dark:text-green-400 italic">
                                Nuovo appartamento (verrà creato al salvataggio)
                            </p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        <p>Nessun appartamento associato.</p>
                        <p class="text-sm mt-2">Clicca su "Aggiungi Appartamento" per iniziare.</p>
                    </div>
                    @endif

                </div>
                <div class="flex justify-end mt-10">
                    <flux:button icon="pencil" variant="filled" wire:click="submit">
                        Modifica
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>