<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/cities">Città</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Città / Dettagli</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/cities">
                Torna Indietro
            </flux:button>
        </div>

        <h3 class="text-xl font-medium mb-4">Condomini di {{ $city->name_city }}</h3>


        <livewire:admin.cities.table-city-condominiums :city="$city" />

    </div>
</div>
