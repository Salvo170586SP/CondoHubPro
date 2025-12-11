<div>
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/residents">Residenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Crea</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Crea Residente</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/residents">
                Torna Indietro
            </flux:button>
        </div>

        <x-step-form :steps="['Dati Anagrafici', 'Dati Catastali', 'Recap']" :currentStep="$currentStep" />

        <div class="overflow-x-auto">
            <div
                class="min-w-full border dark:border-zinc-600 rounded-lg p-5 space-y-5 bg-zinc-100/50 dark:bg-zinc-700/50">
                @if($currentStep == 1)
                <div wire:key="currentStep-{{$currentStep}}-{{ now() }}">
                    <div class="flex gap-10">
                        <div class="space-y-1">
                            <div class="text-sm font-medium">Foto:</div>
                            <x-input-file model="residentStep1.img_user" text="Allega Foto" />
                            <div class="mt-2">
                                @if ($residentStep1->img_user)
                                <img src="{{ $residentStep1->img_user->temporaryUrl() }}" alt="Anteprima foto"
<<<<<<< HEAD
                                    class="h-37 w-37 rounded-lg object-cover border" />
                                @else
=======
                                    class="h-full w-full rounded-lg object-cover border border-zinc-400" />
                                @else 
>>>>>>> staging
                                <div
                                    class="h-37 w-37 bg-zinc-200 rounded-lg border flex justify-center items-center font-bold text-xl uppercase">
                                    NO IMG
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full flex flex-col space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <flux:input wire:model="residentStep1.name" label="Nome" />
                                <flux:input wire:model="residentStep1.surname" label="Cognome" />
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <flux:input wire:model="residentStep1.phone_number" label="Telefono" />
                                <flux:input wire:model="residentStep1.email" label="Email" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-10">
                        <flux:button icon="arrow-right" variant="filled" wire:click="addStep">
                            Avanti
                        </flux:button>
                    </div>
                </div>
                @elseif($currentStep == 2)
                <div wire:key="currentStep-{{$currentStep}}-{{ now() }}">
                    <div>
                        <h2 class="dark:text-zinc-200 font-bold">Dati Catastali</h2>
                        <small class="text-xs font-medium">*Aggiungi i tuoi appartamenti</small>
                    </div>
                    <div class="flex justify-between items-center gap-3 mb-3">
                        <div class="font-medium text-sm">
                            Appartamenti aggiunti
                            <span
                                class="inline-flex justify-center items-center ms-2 w-5 h-5 bg-zinc-600 text-white rounded-full">{{count($residentStep2->newApartment)}}</span>
                        </div>
                        <flux:button icon="plus-circle" variant="filled" class="cursor-pointer"
                            wire:click="openNewApartment">Aggiungi Appartamento</flux:button>
                    </div>
                    {{-- Lista Appartamenti --}}
                    @if(count($residentStep2->newApartment) > 0)
                    <div
                        class="h-[330px] border bg-white dark:bg-zinc-800 dark:border-zinc-500 p-5 rounded-lg overflow-y-auto">
                        @foreach($residentStep2->newApartment as $index => $apartment)
                        <div wire:key="newApartment-{{$index}}-{{str()->random(10)}}"
                            class="w-full border dark:border-zinc-600 rounded-lg p-5 space-y-5 bg-zinc-100/50 dark:bg-zinc-700/50 mt-3 border-zinc-300 ">
                            <div class="flex items-center justify-between">
                                <flux:button icon="minus-circle" size="sm" variant="primary" color="red"
                                    class="cursor-pointer"
                                    wire:confirm="Sei sicuro di voler eliminare questo appartamento?"
                                    wire:click="closeNewApartment({{$index}})">Elimina Appartamento</flux:button>
                                <div
                                    class="bg-black text-white rounded-full w-5 h-5 font-bold flex justify-center items-center">
                                    {{$index +1}}
                                </div>
                            </div>
                            <div class="w-full grid grid-cols-4 gap-2">
                                <flux:input wire:model="residentStep2.newApartment.{{$index}}.name_apartment"
                                    label="Nome Appartamento" />
                                <flux:input wire:model="residentStep2.newApartment.{{$index}}.floor" label="Piano" />
                                <flux:input wire:model="residentStep2.newApartment.{{$index}}.unit_number"
                                    label="Interno" />
                            </div>
                            <div class="w-full grid grid-cols-5 gap-2">
                                <flux:input type="number" wire:model="residentStep2.newApartment.{{$index}}.rooms"
                                    label="Numero Vani" />
                                <flux:input type="number"
                                    wire:model="residentStep2.newApartment.{{$index}}.square_metres"
                                    label="Metri Quadri" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        <p>Nessun appartamento associato.</p>
                        <p class="text-sm mt-2">Clicca su "Aggiungi Appartamento" per iniziare.</p>
                    </div>
                    @endif

                    <div class="flex justify-end gap-3 mt-10">
                        <flux:button icon="arrow-left" variant="filled" wire:click="backStep">
                            Indietro
                        </flux:button>
                        <flux:button icon="arrow-right" variant="filled" wire:click="addStep">
                            Avanti
                        </flux:button>
                    </div>
                </div>
                @else
                <div wire:key="currentStep-{{ $currentStep }}-{{ now() }}">
                    <h3 class="text-xl font-semibold mb-4">Riepilogo dati residente</h3>
                    <div class="flex items-center gap-3 text-sm">
                        <div class="col-span-2">
                            @if ($residentStep1->img_user)
                            <strong>Foto:</strong>
                            <img src="{{ $residentStep1->img_user->temporaryUrl() }}" alt="Anteprima foto"
                                class="h-24 w-24 rounded-lg mt-2 object-cover border" />
                            @else
                            <div
                                class="h-24 w-24 bg-zinc-200 rounded-lg mt-2 border flex justify-center items-center font-bold text-xl uppercase">
                                NO IMG
                            </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div><strong>Nome:</strong> {{ $residentStep1->name }}</div>
                            <div><strong>Cognome:</strong> {{ $residentStep1->surname }}</div>
                            <div><strong>Telefono:</strong> {{ $residentStep1->phone_number }}</div>
                            <div><strong>Email:</strong> {{ $residentStep1->email }}</div>
                        </div>
                    </div>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Appartamenti associati</h3>
                    @if (count($residentStep2->newApartment) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                            <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                                <tr>
                                    <th class="px-4 py-2 text-left">Nome</th>
                                    <th class="px-4 py-2 text-left">Piano</th>
                                    <th class="px-4 py-2 text-left">Interno</th>
                                    <th class="px-4 py-2 text-left">Numero Vani</th>
                                    <th class="px-4 py-2 text-left">Metri Quadri</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                                @foreach ($residentStep2->newApartment as $apartment)
                                <tr>
                                    <td class="px-4 py-2">{{ $apartment['name_apartment'] }}</td>
                                    <td class="px-4 py-2">{{ $apartment['floor'] }}</td>
                                    <td class="px-4 py-2">{{ $apartment['unit_number'] ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $apartment['rooms'] }}</td>
                                    <td class="px-4 py-2">{{ $apartment['square_metres'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div
                        class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
                        Nessun appartamento creato</div>
                    @endif

                    <div class="flex justify-end gap-3 mt-10">
                        <flux:button icon="arrow-left" variant="filled" wire:click="backStep">
                            Indietro
                        </flux:button>
                        <flux:button icon="check" variant="filled" wire:click="submit">
                            Crea
                        </flux:button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>