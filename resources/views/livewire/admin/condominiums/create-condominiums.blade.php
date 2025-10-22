<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Crea</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Condomini / Crea</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/condominiums">
                Torna Indietro
            </flux:button>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full border rounded-lg p-5 space-y-3">
                <flux:input wire:model="name" label="Nome" />
                <flux:input wire:model="address" label="Indirizzo" />
                <flux:input wire:model="cap" label="Cap" />
                <flux:select wire:model="city_id" label="Città" placeholder="Seleziona una città...">
                    <flux:select.option>-</flux:select.option>
                    @foreach ($cities as $city)
                        <flux:select.option value="{{ $city->id }}" wire:key="{{ $city->id }}">
                            {{ $city->name_city }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:select wire:model="administrator_id" label="Amministratore">
                    <flux:select.option>-</flux:select.option>
                    @foreach ($administrators as $administrator)
                        <flux:select.option value="{{ $administrator->id }}" wire:key="{{ $administrator->id }}">
                            {{ $administrator->getFullname()}}</flux:select.option>
                    @endforeach
                </flux:select>

                <div class="flex justify-end mt-10">
                    <flux:button icon="check" variant="filled" wire:click="submit">
                        Crea
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>
