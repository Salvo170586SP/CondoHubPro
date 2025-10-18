<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/apartments">Appartamenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Modifica</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Appartamenti / Modifica</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/apartments">
                Torna Indietro
            </flux:button>
        </div>

        <div class="overflow-x-auto">
            <div class="w-full border rounded-lg p-5 space-y-3">
                <div class="w-full grid grid-cols-3 gap-2">
                    <flux:input wire:model="name" label="Nome" />
                    <flux:input wire:model="floor" label="Piano" />
                    <flux:input wire:model="unit_number" label="Interno" />
                </div>

                <div class="w-full grid grid-cols-3 gap-2 mb-5">
                    <flux:input type="number" wire:model="rooms" label="Numero Vani" />
                    <flux:input type="number" wire:model="square_metres" label="Metri Quadri" />
                </div>
                <flux:separator />
                <div class="w-full grid grid-cols-2 gap-2 mt-5">
                    <flux:select class="" wire:model="condominium_id" label="Condominio di appartenenza">
                        <flux:select.option>Seleziona</flux:select.option>
                        @foreach ($condominiums as $condominium)
                            <flux:select.option value="{{ $condominium->id }}" wire:key="{{ $condominium->id }}">
                                {{ $condominium->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:select wire:model="resident_id" label="Condomino">
                        <flux:select.option>Seleziona</flux:select.option>
                        @foreach ($residents as $resident)
                            <flux:select.option value="{{ $resident->id }}" wire:key="{{ $resident->id }}">
                                {{ $resident->name .  $resident->surname}}</flux:select.option>
                        @endforeach
                    </flux:select>
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
