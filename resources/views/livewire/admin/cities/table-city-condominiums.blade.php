<div>
    <div class="mt-5">
        {{ $cityCondominiums->links('vendor.livewire.tailwind') }}
    </div>
    <div class="overflow-x-auto">
        <div class="min-w-full border dark:border-zinc-600 rounded-lg">
            <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Nome</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Indirizzo</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Cap</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Amministratore</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">
                            Creato il</th>
                        <th class="px-4 py-3 text-left tracking-wider uppercase">
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                    @forelse ($cityCondominiums as $condominium)
                    <tr wire:key="condominium-{{ $condominium->id }}-{{ str()->random(10) }}"
                        class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                        <td class="px-4 py-4 whitespace-nowrap capitalize">
                            {{ $condominium->name }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm capitalize">
                            {{ $condominium->address }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap capitalize">
                            {{ $condominium->cap }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if ($condominium->administrator)
                            {{ $condominium->administrator->getFullName() }}
                            @else
                            -
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $condominium->getDate($condominium->created_at) }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex justify-end gap-2">
                                <flux:button icon="eye" size="sm" variant="filled" wire:navigate
                                    href="/admin/condominiums/{{ $condominium->id }}/show">Dettagli</flux:button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8"
                            class="px-4 py-5 text-center text-sm italic bg-zinc-50 text-gray-400 dark:text-gray-400 font-medium">
                            Nessun condominio registrato
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>