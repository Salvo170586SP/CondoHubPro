<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{ $condominium->id }}/show">Dettagli
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{ $condominium->id }}/feedbacks">Segnalazioni
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">
                Dettagli Segnalazione
            </h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate
                href="/admin/condominiums/{{ $condominium->id }}/feedbacks">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full grid grid-cols-3 gap-5 mb-5">
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
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Numero Appartamenti:</div>
                    {{ $condominium->apartments->count() }}
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


        <div class="w-full flex gap-5">
            <div class="w-full">
                <div
                    class="w-full p-5 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                    <div class="flex justify-between font-bold ">
                        <div class="capitalize">
                            <span class="text-sm font-medium dark:text-zinc-400 me-1">Titolo:</span>
                            {{ $feedback->title }}
                        </div>
                        <div class="capitalize font-bold">
                            <span class="text-sm font-medium">Segnalato da:</span>
                            {{ $feedback->creator->getFullName() }}
                        </div>
                        <div class="">
                            <span class="inline-block text-sm font-medium mb-2 dark:text-zinc-400 me-1">Segnalato
                                il:</span>
                            {{ $feedback->getDate($feedback->created_at) }}
                        </div>
                        <div class="font-bold">
                            <span class="text-sm font-medium dark:text-zinc-400 me-1">Priorità:</span>
                            @foreach ($priorities as $priority)
                                @if ($feedback->priority == $priority['id'])
                                    <span
                                        class="{{ $priority['color'] }} px-3 py-1 text-white rounded-lg">{{ $priority['label'] }}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="capitalize my-5">
                        <span class="inline-block text-sm font-medium mb-2 dark:text-zinc-400">Descrizione:</span>
                        <div class="capitalize border dark:border-zinc-500 rounded-lg p-3 bg-white dark:bg-zinc-800">
                            <p class="uppercase">
                                {{ $feedback->description }}
                            </p>
                        </div>
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>
