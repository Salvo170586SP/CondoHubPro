<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{ $condominium->id }}/show">Dettagli</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Modifica Appartamento</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Appartamenti / Modifica</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate
                href="/admin/condominiums/{{ $condominium->id }}/show">
                Torna Indietro
            </flux:button>
        </div>

        <div class="overflow-x-auto">
            <div class="w-full border dark:border-zinc-600 rounded-lg p-5 space-y-3 bg-zinc-100/50 dark:bg-zinc-700/50">
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
                    <flux:select wire:model="resident_id" label="Residente">
                        <flux:select.option>Seleziona</flux:select.option>
                        @foreach ($residents as $resident)
                            <flux:select.option value="{{ $resident->id }}" wire:key="{{ $resident->id }}">
                                {{ $resident->name . $resident->surname }}</flux:select.option>
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
