<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Condomini / Dettagli</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/condominiums">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-5">
            <div class="w-[400px] h-full p-5 rounded-lg shadow">
                <div class="flex-col items-center space-y-3">
                    <div class="text-sm text-gray-900 capitalize">
                        <div class="text-sm font-medium">Nome:</div>
                        {{ $condominium->name }}
                    </div>
                    <div class="text-sm text-gray-900 capitalize">
                        <div class="text-sm font-medium">Indirizzo:</div>
                        {{ $condominium->address }}
                    </div>
                    <div class="text-sm text-gray-900 capitalize">
                        <div class="text-sm font-medium">Cap:</div>
                        {{ $condominium->cap }}
                    </div>

                    <div class="text-sm text-gray-900 capitalize">
                        <div class="text-sm font-medium">Città:</div>
                        {{ $condominium->city->name_city }}
                    </div>
                    <div class="text-sm text-gray-900">
                        <div class="text-sm font-medium">Creato il:</div>
                        {{ $condominium->getDate($condominium->created_at) }}
                    </div>

                    <div class="text-sm text-gray-900 capitalize">
                        <div class="text-sm font-medium">Numero Appartamenti:</div>
                        {{ $condominium->apartments->count() }}
                    </div>
                    <div class="text-sm text-gray-900 capitalize">
                        <div class="text-sm font-medium">Amministratore:</div>
                        {{ $condominium->administrator->getFullName() }}
                    </div>
                </div>
            </div>

            <div class="w-full p-5 rounded-lg shadow">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-bold mb-5">Bacheca</h2>
                    <livewire:admin.noticesBoard.create-notices :condominium_id="$condominium->id" />
                </div>
              
                <livewire:admin.noticesBoard.card-notices :condominium="$condominium" />
            </div>

        </div>
    </div>
</div>
