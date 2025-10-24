<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Città</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Città</h2>
            <livewire:admin.cities.create-city />
        </div>
        <div class="w-100 my-3">
            <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
        </div>
        @if ($cities && $cities->count() > 0)
            <div class="overflow-x-auto">
                <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                        <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Città</th>
                                <th
                                    class="px-6 py-3 text-center text-xs uppercase tracking-wider">
                                    Provincia</th>
                                <th
                                    class="px-6 py-3  text-xs text-center uppercase tracking-wider">
                                    Numero Condomini</th>
                                <th
                                    class="px-6 py-3 text-center text-xs uppercase tracking-wider">
                                    Creato il</th>
                                <th
                                    class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                            @foreach ($cities as $city)
                                <tr wire:key="city-{{ $city->id }}-{{ str()->random(10) }}"
                                    class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white transition-colors text-sm">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $city->name_city }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center uppercase">
                                        {{ $city->name_prov }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $city->condominiums->count() }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $city->getDate($city->created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-end gap-2">
                                            <flux:button icon="eye" variant="filled" wire:navigate
                                                href="/admin/cities/{{ $city->id }}/show" />
                                            <livewire:admin.cities.edit-city :city="$city"
                                                wire:key="city-edit-{{ $city->id }}-{{ str()->random(10) }}" />
                                            <livewire:admin.cities.delete-city :city="$city"
                                                wire:key="city-delete-{{ $city->id }}-{{ str()->random(10) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mx-1 mt-5">
                    {{ $cities->links() }}
                </div>
            </div>
        @else
            <div class="font-medium italic w-full text-center mt-10">non ci sono elementi</div>
        @endif
    </div>
</div>
