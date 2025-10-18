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
                                    {{ $resident->apartment->name ? $resident->apartment->name : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Piano:</div>
                                    {{ $resident->apartment->floor ? $resident->apartment->floor : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Interno:</div>
                                    {{ $resident->apartment->unit_number ? $resident->apartment->unit_number : '-' }}
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Metri Quadri:</div>
                                    {{ $resident->apartment->square_metres ? $resident->apartment->square_metres : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Numero Vani:</div>
                                    {{ $resident->apartment->rooms ? $resident->apartment->rooms : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Data Creazione:</div>
                                    {{ $resident->apartment->getDate($resident->created_at) }}
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
                                    {{ $resident->apartment ? $resident->apartment->condominium->name : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Amministratore</div>
                                    {{ $resident->apartment ? $resident->apartment->condominium->administrator->name . ' ' . $resident->apartment->condominium->administrator->surname : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Città:</div>
                                    {{ $resident->apartment ? $resident->apartment->condominium->city->name_city : '-' }}
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Indirizzo:</div>
                                    {{ $resident->apartment ? $resident->apartment->condominium->address : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Cap:</div>
                                    {{ $resident->apartment ? $resident->apartment->condominium->cap : '-' }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <div class="font-medium">Data Creazione:</div>
                                    {{ $resident->apartment->condominium->getDate($resident->apartment->condominium->created_at) }}
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
