<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/administrators">Amminsitratori</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Crea</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Amminsitratori / Crea</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/administrators">
                Torna Indietro
            </flux:button>
        </div>

        <x-step-form :currentStep="$currentStep" />


        <div class="overflow-x-auto bg-zinc-100/30 rounded-lg">
            @if ($currentStep == 1)
                <div wire:key="currentStep-{{ $currentStep }}-{{ now() }}">
                    <div class="min-w-full border rounded-lg p-5 space-y-3">
                        <flux:input wire:model="administratorsStep1.name" label="Nome" />
                        <flux:input wire:model="administratorsStep1.surname" label="Cognome" />
                        <flux:input wire:model="administratorsStep1.phone_number" label="Telefono" />
                        <flux:input wire:model="administratorsStep1.email" label="Email" />
                        <flux:input type="file" wire:model="administratorsStep1.img_user" label="Allega Foto" />
                        <div class="flex justify-end mt-10">
                            <flux:button icon:trailing="arrow-right" variant="filled" wire:click="addStep">
                                Avanti
                            </flux:button>
                        </div>
                    </div>
                </div>
            @elseif($currentStep == 2)
                <div wire:key="currentStep-{{ $currentStep }}-{{ now() }}">
                    <div class="min-w-full border rounded-lg p-5 space-y-3">
                        <div>
                            @error('selectedCondominiums')
                                <div class="text-red-500 text-sm my-2">{{ $message }}</div>
                            @enderror
                            @if ($condominiums && $condominiums->count() > 0)
                                <div class="overflow-x-auto">
                                    <div class="min-w-full border rounded-lg">
                                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Aggiungi
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Nome
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Indirizzo</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Cap</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Città</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Creato il
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($condominiums as $condominium)
                                                    <tr wire:key="condominium-{{ $condominium->id }}-{{ str()->random(10) }}"
                                                        class="hover:bg-gray-50 transition-colors">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            <flux:checkbox wire:model="selectedCondominiums"
                                                                value="{{ $condominium->id }}" />
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $condominium->name }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 uppercase">
                                                            {{ $condominium->address }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $condominium->cap }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $condominium->city->name_city }}
                                                        </td>

                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $condominium->getDate($condominium->created_at) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mx-1 mt-5">
                                        {{ $condominiums->links() }}
                                    </div>
                                </div>
                            @else
                                <div class="font-medium italic w-full text-center mt-10">non ci sono elementi</div>
                            @endif
                        </div>
                        <div class="flex justify-end gap-3 mt-10">
                            <flux:button icon="arrow-left" variant="filled" wire:click="backStep">
                                Indietro
                            </flux:button>
                            <flux:button icon:trailing="arrow-right" variant="filled" wire:click="addStep">
                                Avanti
                            </flux:button>
                        </div>
                    </div>
                </div>
            @elseif($currentStep == 3)
                <div wire:key="currentStep-{{ $currentStep }}-{{ now() }}">
                    <div class="min-w-full border rounded-lg p-5 space-y-5">

                        <h3 class="text-xl font-semibold mb-4">Riepilogo dati amministratore</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div><strong>Nome:</strong> {{ $administratorsStep1->name }}</div>
                            <div><strong>Cognome:</strong> {{ $administratorsStep1->surname }}</div>
                            <div><strong>Telefono:</strong> {{ $administratorsStep1->phone_number }}</div>
                            <div><strong>Email:</strong> {{ $administratorsStep1->email }}</div>

                            @if ($administratorsStep1->img_user)
                                <div class="col-span-2">
                                    <strong>Foto:</strong>
                                    <img src="{{ $administratorsStep1->img_user->temporaryUrl() }}"
                                        alt="Anteprima foto" class="h-24 w-24 rounded-full mt-2 object-cover border" />
                                </div>
                            @endif
                        </div>

                        <h3 class="text-xl font-semibold mt-8 mb-4">Condomìni selezionati</h3>

                        @if ($selectedCondominiumList && $selectedCondominiumList->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white rounded-lg border">
                                    <thead class="bg-gray-100 text-xs uppercase text-gray-500">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Nome</th>
                                            <th class="px-4 py-2 text-left">Indirizzo</th>
                                            <th class="px-4 py-2 text-left">Città</th>
                                            <th class="px-4 py-2 text-left">Cap</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 text-sm">
                                        @foreach ($selectedCondominiumList as $condominium)
                                            <tr>
                                                <td class="px-4 py-2">{{ $condominium->name }}</td>
                                                <td class="px-4 py-2">{{ $condominium->address }}</td>
                                                <td class="px-4 py-2">{{ $condominium->city->name_city }}</td>
                                                <td class="px-4 py-2">{{ $condominium->cap }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-sm italic text-gray-500">Nessun condominio selezionato.</div>
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
