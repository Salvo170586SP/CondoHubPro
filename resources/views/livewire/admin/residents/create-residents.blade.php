<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/residents">Residenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Crea</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Crea Residente</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/residents">
                Torna Indietro
            </flux:button>
        </div>

        <div class="overflow-x-auto">
            <div
                class="min-w-full border dark:border-zinc-600 rounded-lg p-5 space-y-5 bg-zinc-100/50 dark:bg-zinc-700/50">
                <h2 class="dark:text-zinc-200 font-bold mb-5">Dati Anagrafici</h2>
                <div class="border-b dark:border-zinc-600 pb-5 space-y-5">
                    <div class="grid grid-cols-2 gap-3">
                        <flux:input wire:model="name" label="Nome" />
                        <flux:input wire:model="surname" label="Cognome" />
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <flux:input wire:model="phone_number" label="Telefono" />
                        <flux:input wire:model="email" label="Email" />
                        <flux:input type="file" wire:model="img_user" label="Allega Foto" />
                    </div>
                </div>

                <div>
                    <h2 class="dark:text-zinc-200 font-bold">Dati Catastali</h2>
                    <small class="text-xs font-medium">*Aggiungi i tuoi appartamenti</small>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <div class="font-medium text-sm">
                        Appartamenti aggiunti
                        <span
                            class="inline-flex justify-center items-center ms-2 w-5 h-5 bg-zinc-600 text-white rounded-full">{{count($newApartment)}}</span>
                    </div>
                    <flux:button icon="plus-circle" variant="primary" class="cursor-pointer"
                        wire:click="openNewApartment">Aggiungi Appartamento</flux:button>
                </div>

                {{-- Lista Appartamenti --}}
                @if(count($newApartment) > 0)
                <div class="h-[330px] border bg-white p-5 rounded-lg overflow-y-auto">
                    @foreach($newApartment as $index => $apartment)
                    <div wire:key="newApartment-{{$index}}-{{str()->random(10)}}"
                        class="w-full border dark:border-zinc-600 rounded-lg p-5 space-y-5 bg-zinc-100/50 dark:bg-zinc-700/50 mt-3 border-zinc-300 ">
                        <div class="flex items-center justify-between">
                            <flux:button icon="minus-circle" size="sm" variant="primary" color="red"
                                class="cursor-pointer" wire:confirm="Sei sicuro di voler eliminare questo appartamento?"
                                wire:click="closeNewApartment({{$index}})">Elimina Appartamento</flux:button>
                            <div
                                class="bg-black text-white rounded-full w-5 h-5 font-bold flex justify-center items-center">
                                {{$index +1}}
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-4 gap-2">
                            <flux:input wire:model="newApartment.{{$index}}.name_apartment" label="Nome Appartamento" />
                            <flux:input wire:model="newApartment.{{$index}}.floor" label="Piano" />
                            <flux:input wire:model="newApartment.{{$index}}.unit_number" label="Interno" />
                        </div>
                        <div class="w-full grid grid-cols-5 gap-2">
                            <flux:input type="number" wire:model="newApartment.{{$index}}.rooms" label="Numero Vani" />
                            <flux:input type="number" wire:model="newApartment.{{$index}}.square_metres"
                                label="Metri Quadri" />
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                    <p>Nessun appartamento associato.</p>
                    <p class="text-sm mt-2">Clicca su "Aggiungi Appartamento" per iniziare.</p>
                </div>
                @endif

                <div class="flex justify-end mt-10">
                    <flux:button icon="check" variant="filled" wire:click="submit">
                        Crea
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>