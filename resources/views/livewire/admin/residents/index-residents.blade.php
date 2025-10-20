<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item>Residenti</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
                <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
                <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Residenti</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/residents/create">
                Crea
            </flux:button>
        </div>
        @if ($residents && $residents->count() > 0)
            <div class="overflow-x-auto">
                <div class="min-w-full border rounded-lg">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome e Cognome
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Telefono
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Condominio di Residenza
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Appartamento
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Creato il</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($residents as $resident)
                                <tr wire:key="resident-{{ $resident->id }}-{{ str()->random(10) }}"
                                    class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                                        {{ $resident->name . ' ' . $resident->surname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $resident->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $resident->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @isset ($resident->apartment->condominium)
                                            {{ $resident->apartment->condominium->name }}
                                        @else
                                            -
                                        @endisset
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @isset($resident->apartment->condominium)
                                        {{ $resident->apartment->name }}
                                        @else
                                            -
                                        @endisset
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $resident->getDate($resident->created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex justify-end gap-2">
                                            <flux:button icon="eye" variant="filled" wire:navigate
                                                href="/residents/{{ $resident->id }}/show">
                                            </flux:button>
                                            <flux:button icon="pencil" variant="filled" wire:navigate
                                                href="/residents/{{ $resident->id }}/edit">
                                            </flux:button>
                                            <livewire:admin.residents.delete-residents :resident="$resident"
                                                wire:key="resident-delete-{{ $resident->id }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mx-1 mt-5">
                    {{ $residents->links() }}
                </div>
            </div>
        @else
            <div class="font-medium italic w-full text-center mt-10">non ci sono elementi</div>
        @endif
    </div>
</div>
