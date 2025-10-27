<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/administrators">Amministratori</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Dettagli Amministratore</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/administrators">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-5">

            <div class="w-[380px] p-5 rounded-lg bg-zinc-100/30 dark:bg-zinc-700/50 shadow">
                <div class="mb-3 flex justify-between">
                    @if ($administrator->img_user)
                        <flux:avatar size="xl" src="{{ asset('storage/' . $administrator->img_user) }}" />
                    @else
                        <flux:avatar name="{{ $administrator->name . ' ' . $administrator->surname }}" />
                    @endif
                    <flux:button icon="pencil" variant="filled" wire:navigate
                        href="/admin/administrators/{{ $administrator->id }}/edit"> Modifica
                    </flux:button>
                </div>
                <div class="space-y-5 my-5 text-gray-900 dark:text-white">
                    <div class="text-sm">
                        <div class="font-medium">Nome e Cognome:</div>
                        {{ $administrator->name . ' ' . $administrator->surname }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Telefono:</div>
                        {{ $administrator->phone_number }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Email:</div>
                        {{ $administrator->email }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Numero Condomini:</div>
                        {{ $administrator->condominiums->count() }}
                    </div>
                </div>
            </div>

            <div class="w-full p-5 rounded-lg shadow bg-zinc-100/30 dark:bg-zinc-700/50">
                <h2 class="w-full text-lg font-medium mb-5">Condomini Gestiti</h2>
                <div class="w-100 my-3">
                    <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
                </div>
                <div class="overflow-x-auto">
                    <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                            <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium text-xs">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left uppercase tracking-wider">
                                        Nome</th>
                                    <th
                                        class="px-6 py-3 text-left uppercase tracking-wider">
                                        Indirizzo</th>
                                    <th
                                        class="px-6 py-3 text-left not-even:uppercase tracking-wider">
                                        Cap</th>
                                    <th
                                        class="px-6 py-3 text-left not-only:uppercase tracking-wider">
                                        Città</th>
                                    <th
                                        class="px-6 py-3 text-left uppercase tracking-wider">
                                        Creato il</th>
                                    <th
                                        class="px-6 py-3 text-left uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                                @foreach ($condominiums as $condominium)
                                    <tr wire:key="condominiumAdmin-{{ $condominium->id }}-{{ str()->random(10) }}"
                                        class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            {{ $condominium->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            {{ $condominium->address }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $condominium->cap }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            {{ $condominium->city->name_city }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $condominium->getDate($condominium->created_at) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex justify-end">
                                                <flux:button variant="filled" icon="eye" wire:navigate
                                                    href="/admin/condominiums/{{ $condominium->id }}/show" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-1 mt-5">
                        {{ $condominiums->links('vendor.livewire.tailwind') }}
                    </div>
                </div>
                @if ($condominiums->count() == 0)
                    <div class="w-full text-center italic"> Non ci sono elementi associati</div>
                @endif
            </div>

        </div>
    </div>
</div>
