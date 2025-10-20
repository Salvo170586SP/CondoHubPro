<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/residents">Residenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Residenti / Dettagli</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/residents">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-5">

            <div class="w-[380px] h-full p-5 rounded-lg shadow">
                <div class="mb-3 flex justify-between">
                    @if ($resident->img_user)
                        <flux:avatar size="xl" src="{{ asset('storage/' . $resident->img_user) }}" />
                    @else
                        <flux:avatar name="{{ $resident->name . ' ' . $resident->surname }}" />
                    @endif
                    <flux:button icon="pencil" variant="filled" wire:navigate
                        href="/residents/{{ $resident->id }}/edit"> Modifica
                    </flux:button>
                </div>
                <div class="space-y-5 my-5">
                    <div class="text-sm text-gray-900">
                        <div class="font-medium">Nome e Cognome:</div>
                        {{ $resident->name . ' ' . $resident->surname }}
                    </div>
                    <div class="text-sm text-gray-900">
                        <div class="font-medium">Telefono:</div>
                        {{ $resident->phone_number }}
                    </div>
                    <div class="text-sm text-gray-900">
                        <div class="font-medium">Email:</div>
                        {{ $resident->email }}
                    </div>

                </div>
            </div>

            <div class="w-full p-5 rounded-lg shadow">
                <div>
                    <h2 class="w-full text-lg font-medium mb-5">Dati Appartamento di Residenza</h2>
                    <div class="overflow-x-auto">
                        <div class="min-w-full border rounded-lg p-3 space-y-3">
                            <div class="grid grid-cols-3">
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Nome Appartamento:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->name }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Piano:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->floor }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Interno:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->unit_number }}
                                    @else
                                        -
                                    @endisset
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Metri Quadri:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->square_metres }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Numero Vani:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->rooms }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
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
                        <div class="min-w-full border rounded-lg p-3 space-y-3">
                            <div class="grid grid-cols-3">
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Nome Condominio:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->name }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Amministratore</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->administrator->name . ' ' . $resident->apartment->condominium->administrator->surname }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Città:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->city->name_city }}
                                    @else
                                        -
                                    @endisset
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Indirizzo:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->address }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Cap:</div>
                                    @isset($resident->apartment)
                                        {{ $resident->apartment->condominium->cap }}
                                    @else
                                        -
                                    @endisset
                                </div>
                                <div class="text-sm text-gray-900">
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
