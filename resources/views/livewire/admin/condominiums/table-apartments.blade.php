<div>
    @if ($apartments && $apartments->count() > 0)
        <div class="overflow-x-auto">
            <div class="min-w-full border rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Piano</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Interno</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stanze</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Metri Quadri</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Residente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Creato il</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($apartments as $apartment)
                            <tr wire:key="apartment-{{ $apartment->id }}-{{ str()->random(10) }}"
                                class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                                    {{ $apartment->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 uppercase">
                                    {{ $apartment->floor ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($apartment->unit_number)
                                        {{ $apartment->unit_number ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $apartment->rooms ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $apartment->square_metres ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                                    @if ($apartment->resident)
                                        {{ $apartment->resident->getFullName() }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $apartment->getDate($apartment->created_at) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex justify-end gap-2">
                                        <flux:button icon="pencil" variant="filled" wire:navigate
                                            href="/condominiums/{{ $condominium->id }}/apartments/{{ $apartment->id }}/edit">
                                        </flux:button>
                                        <livewire:admin.apartments.delete-apartments :condominium="$condominium" :apartment="$apartment"
                                            wire:key="apartment-delete-{{ $apartment->id }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-1 mt-5">
                {{ $apartments->links() }}
            </div>
        </div>
    @else
        <div class="w-full text-center font-medium text-sm">
            Non ci sono note in bacheca
        </div>
    @endif
</div>
