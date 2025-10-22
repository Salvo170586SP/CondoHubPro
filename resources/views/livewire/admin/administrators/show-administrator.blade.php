<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/administrators">Amministratori</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Amministratori / Dettagli</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/administrators">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-5">

            <div class="w-[380px] p-5 rounded-lg shadow">
                <div class="mb-3 flex justify-between">
                    @if ($administrator->img_user)
                        <flux:avatar size="xl" src="{{ asset('storage/' . $administrator->img_user) }}" />
                    @else
                        <flux:avatar name="{{ $administrator->name . ' ' . $administrator->surname }}" />
                    @endif
                    <flux:button icon="pencil" variant="filled" wire:navigate
                        href="/administrators/{{ $administrator->id }}/edit"> Modifica
                    </flux:button>
                </div>
                <div class="space-y-5 my-5">
                    <div class="text-sm text-gray-900">
                        <div class="font-medium">Nome e Cognome:</div>
                        {{ $administrator->name . ' ' . $administrator->surname }}
                    </div>
                    <div class="text-sm text-gray-900">
                        <div class="font-medium">Telefono:</div>
                        {{ $administrator->phone_number }}
                    </div>
                    <div class="text-sm text-gray-900">
                        <div class="font-medium">Email:</div>
                        {{ $administrator->email }}
                    </div>
                    <div class="text-sm text-gray-900">
                        <div class="font-medium">Numero Condomini:</div>
                        {{ $administrator->condominiums->count() }}
                    </div>
                </div>
            </div>

            <div class="w-full p-5 rounded-lg shadow">
                <h2 class="w-full text-lg font-medium mb-5">Condomini Gestiti</h2>
                <div class="overflow-x-auto">
                    <div class="min-w-full border rounded-lg">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome</th>
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
                                        Creato il</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($condominiums as $condominium)
                                    <tr wire:key="condominiumAdmin-{{ $condominium->id }}-{{ str()->random(10) }}"
                                        class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $condominium->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 uppercase">
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex justify-end">
                                                <flux:button variant="filled" icon="eye" wire:navigate
                                                    href="/condominiums/{{ $condominium->id }}/show" />
                                            </div>
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
                @if ($condominiums->count() == 0)
                    <div class="w-full text-center italic"> Non ci sono elementi associati</div>
                @endif
            </div>

        </div>
    </div>
</div>
