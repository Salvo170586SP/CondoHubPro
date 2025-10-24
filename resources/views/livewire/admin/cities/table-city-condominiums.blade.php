<div>
    @if ($city && $cityCondominiums->count() > 0)
        <div class="overflow-x-auto">
            <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                    <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Nome</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Indirizzo</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Cap</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Amministratore</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                Creato il</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                        @foreach ($cityCondominiums as $condominium)
                            <tr wire:key="condominium-{{ $condominium->id }}-{{ str()->random(10) }}"
                                class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white transition-colors text-sm">
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    {{ $condominium->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm capitalize">
                                    {{ $condominium->address }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    {{ $condominium->cap }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($condominium->administrator)
                                        {{ $condominium->administrator->getFullName() }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $condominium->getDate($condominium->created_at) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-end gap-2">
                                        <flux:button icon="eye" variant="filled" wire:navigate
                                            href="/admin/condominiums/{{ $condominium->id }}/show" />
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
