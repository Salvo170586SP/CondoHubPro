<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/residents">Residenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Modifica</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Residenti / Modifica</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/residents">
                Torna Indietro
            </flux:button>
        </div>

        <div class="overflow-x-auto">

            <div class="min-w-full border rounded-lg p-5 space-y-5">
                <div class="grid grid-cols-2 gap-3">
                    <flux:input wire:model="name" label="Nome" />
                    <flux:input wire:model="surname" label="Cognome" />
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <flux:input wire:model="phone_number" label="Telefono" />
                    <flux:select wire:model="apartment_id" label="Appartamento di residenza">
                        <flux:select.option>Seleziona</flux:select.option>
                        @foreach ($apartments as $apartment)
                            <flux:select.option value="{{ $apartment->id }}" wire:key="{{ $apartment->id }}">
                                {{ $apartment->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:input type="file" wire:model="img_user" label="Allega Foto" />
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
