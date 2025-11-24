<div>

    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{$condominium->id}}/show">Dettagli</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Bacheca</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Bacheca</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/condominiums/{{$condominium->id}}/show">
                Torna Indietro
            </flux:button>
        </div>
              <div class="w-full grid grid-cols-3 gap-3 mb-3">
            <div
                class="h-full p-5 flex-col items-center space-y-3 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                <div class="flex justify-between">
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Nome:</div>
                        {{ $condominium->name }}
                    </div>
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Indirizzo:</div>
                        {{ $condominium->address }}
                    </div>
                </div>

                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Cap:</div>
                    {{ $condominium->cap }}
                </div>
            </div>

            <div
                class="h-full p-5 flex-col items-center space-y-3 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
    
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Città:</div>
                    {{ $condominium->city->name_city }}
                </div>
                <div class="text-sm">
                    <div class="text-sm font-medium">Creato il:</div>
                    {{ $condominium->getDate($condominium->created_at) }}
                </div>
            </div>
    
            <div
                class="p-5 flex-col items-center space-y-3 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                <div class="text-sm capitalize flex ju">
                    <div class="text-sm font-medium">Numero Appartamenti:</div>
                    <span
                        class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-900 text-white h-5 w-5 rounded-lg ms-3">
                        {{ $condominium->apartments->count() }} </span>
                </div>
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Amministratore:</div>
                    @if ($condominium->administrator)
                    {{ $condominium->administrator->getFullName() }}
                    @else
                    -
                    @endif
                </div>
            </div>
        </div>

        <div class="w-full space-y-5">
            <div
                class="w-full p-5 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50 ">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-bold flex items-center">Bacheca <span
                            class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-600 text-white h-5 w-5 rounded-lg ms-2">{{
                            $noticesBoardCount }}</span>
                    </h2>
                    <livewire:admin.noticesBoard.create-notices :condominium_id="$condominium->id" />
                </div>
                <livewire:admin.noticesBoard.card-notices :condominium="$condominium" />
            </div>

        </div>
    </div>
</div>