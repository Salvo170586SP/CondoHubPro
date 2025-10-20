<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item>Condomini</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
                <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
                <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Condomini</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/condominiums/create">
                Crea
            </flux:button>
        </div>
        @if ($condominiums && $condominiums->count() > 0)
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
                                    Amministratore</th>
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
                                <tr wire:key="condominium-{{ $condominium->id }}-{{ str()->random(10) }}"
                                    class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $condominium->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $condominium->address }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $condominium->cap }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $condominium->city->name_city }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($condominium->administrator)
                                        {{ $condominium->administrator->name . $condominium->administrator->surname }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $condominium->getDate($condominium->created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex justify-end gap-2">
                                            <flux:button icon="eye" variant="filled" wire:navigate
                                                href="/condominiums/{{ $condominium->id }}/show">
                                            </flux:button>
                                            <flux:button icon="pencil" variant="filled" wire:navigate
                                                href="/condominiums/{{ $condominium->id }}/edit">
                                            </flux:button>
                                            <livewire:admin.condominiums.delete-condominium :condominium="$condominium"
                                                wire:key="condominium-delete-{{ $condominium->id }}" />
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
        @else
            <div class="font-medium italic w-full text-center mt-10">non ci sono elementi</div>
        @endif
    </div>
</div>
