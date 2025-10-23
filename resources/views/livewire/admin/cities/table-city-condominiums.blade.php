<div>
    @if ($city && $cityCondominiums->count() > 0)
        <div class="overflow-x-auto">
            <div class="min-w-full border rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Indirizzo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cap</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amministratore</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Creato il</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($cityCondominiums as $condominium)
                            <tr wire:key="condominium-{{ $condominium->id }}-{{ str()->random(10) }}"
                                class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                                    {{ $condominium->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                                    {{ $condominium->address }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                                    {{ $condominium->cap }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($condominium->administrator)
                                        {{ $condominium->administrator->getFullName() }}
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
                                            href="/condominiums/{{ $condominium->id }}/show" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-1 mt-5">
                {{ $cityCondominiums->links() }}
            </div>
        </div>
    @else
        <div class="font-medium italic w-full text-center mt-10">non ci sono elementi</div>
    @endif
</div>
