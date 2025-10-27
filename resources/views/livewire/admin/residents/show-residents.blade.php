<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/residents">Residenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Dettagli Residenti</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/residents">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-5">

            <div class="w-[380px] h-full p-5 rounded-lg shadow border bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                <div class="mb-3 flex justify-between">
                    @if ($resident->img_user)
                        <flux:avatar size="xl" src="{{ asset('storage/' . $resident->img_user) }}" />
                    @else
                        <flux:avatar name="{{ $resident->name . ' ' . $resident->surname }}" />
                    @endif
                    <flux:button icon="pencil" variant="filled" wire:navigate
                        href="/admin/residents/{{ $resident->id }}/edit"> Modifica
                    </flux:button>
                </div>
                <div class="space-y-5 my-5  text-gray-900 dark:text-white">
                    <div class="text-sm">
                        <div class="font-medium">Nome e Cognome:</div>
                        {{ $resident->name . ' ' . $resident->surname }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Telefono:</div>
                        {{ $resident->phone_number }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Email:</div>
                        {{ $resident->email }}
                    </div>

                </div>
            </div>

            <div class="w-full p-5 rounded-lg shadow border dark:border-zinc-600 bg-zinc-100/50 dark:bg-zinc-700/50">
                <div>
                    <h2 class="w-full text-lg font-medium mb-5">Dati Appartamento di Residenza</h2>
                    <div class="overflow-x-auto">
                        <div class="min-w-full border dark:border-zinc-600 rounded-lg text-gray-900 dark:text-white p-3 space-y-3 bg-white dark:bg-zinc-700">
                            <div class="grid grid-cols-3">
                                <div class="text-sm">
                                    <div class="font-medium">Nome Appartamento:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->name }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Piano:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->floor }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Interno:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->unit_number }}
                                    @else
                                        -
                                    @endisset
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-sm">
                                    <div class="font-medium">Metri Quadri:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->square_metres }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Numero Vani:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->rooms }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Data Creazione:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->getDate($resident->created_at) }}
                                    @else
                                        -
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h2 class="w-full text-lg font-medium mb-5">Dati Condominio</h2>
                    <div class="overflow-x-auto">
                        <div class="min-w-full border dark:border-zinc-600 text-gray-900 dark:text-white rounded-lg p-3 space-y-3 bg-white dark:bg-zinc-700">
                            <div class="grid grid-cols-3">
                                <div class="text-sm">
                                    <div class="font-medium">Nome Condominio:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->name }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Amministratore</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->administrator->name . ' ' . $resident->apartment->condominium->administrator->surname }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Città:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->city->name_city }}
                                    @else
                                        -
                                    @endisset
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-sm">
                                    <div class="font-medium">Indirizzo:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->address }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Cap:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->cap }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium">Data Creazione:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->getDate($resident->apartment->condominium->created_at) }}
                                    @else
                                        -
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
