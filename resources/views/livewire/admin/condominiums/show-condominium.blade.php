<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Condomini / Dettagli</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/condominiums">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-5">
            <div class="w-[400px] h-full p-5 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                <div class="flex-col items-center space-y-3">
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Nome:</div>
                        {{ $condominium->name }}
                    </div>
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Indirizzo:</div>
                        {{ $condominium->address }}
                    </div>
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Cap:</div>
                        {{ $condominium->cap }}
                    </div>

                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Città:</div>
                        {{ $condominium->city->name_city }}
                    </div>
                    <div class="text-sm">
                        <div class="text-sm font-medium">Creato il:</div>
                        {{ $condominium->getDate($condominium->created_at) }}
                    </div>

                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Numero Appartamenti:</div>
                        {{ $condominium->apartments->count() }}
                    </div>
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Amministratore:</div>
                        @if($condominium->administrator)
                        {{ $condominium->administrator->getFullName() }}
                        @else
                        -
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-full space-y-5">
                <div class="w-full p-5 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50 ">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-lg font-bold flex items-center">Bacheca <span
                                class="inline-flex items-center justify-center font-medium text-sm bg-zinc-500 dark:bg-zinc-900 text-white p-2 h-5 w-5 rounded-full ms-2">{{ $noticesBoardCount }}</span>
                        </h2>
                        <livewire:admin.noticesBoard.create-notices :condominium_id="$condominium->id" />
                    </div>
                    <livewire:admin.noticesBoard.card-notices :condominium="$condominium" />
                </div>

                <div class="w-full p-5 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-lg font-bold mb-5 flex items-center">Appartamenti <span
                                class="inline-flex items-center justify-center font-medium text-sm bg-zinc-500 dark:bg-zinc-900 text-white p-2 h-5 w-5 rounded-full ms-2">{{ $apartmentsCount }}</span>
                        </h2>
                        <flux:button icon="plus" variant="filled" wire:navigate
                            href="/admin/condominiums/{{ $condominium->id }}/apartments/create">
                            Crea
                        </flux:button>
                    </div>

                    <div class="w-full h-[10px] mb-7">
                        @if (session('messageApartment'))
                            <flux:badge color="zinc" class="w-full p-2">{{ session('messageApartment') }}
                            </flux:badge>
                        @elseif(session('errorApartment'))
                            <flux:badge color="red" class="w-full p-2">{{ session('errorApartment') }}</flux:badge>
                        @endif
                    </div>
                    <livewire:admin.condominiums.table-apartments :condominium="$condominium" />
                </div>
            </div>
        </div>
    </div>
</div>
