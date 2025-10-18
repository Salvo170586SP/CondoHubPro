<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/dashboard" icon="home" />
            <flux:breadcrumbs.item>Città</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Città</h2>
            <livewire:admin.cities.create-city />
        </div>
        @if ($cities && $cities->count() > 0)
            <div class="overflow-x-auto">
                <div class="min-w-full border rounded-lg">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Città</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Provincia</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Creato il</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($cities as $city)
                                <tr wire:key="city-{{ $city->id }}-{{ str()->random(10) }}"
                                    class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $city->name_city }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 uppercase">
                                        {{ $city->name_prov }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $city->getDate($city->created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex justify-end gap-2">
                                            <livewire:admin.cities.edit-city :city="$city"
                                                wire:key="city-edit-{{ $city->id }}" />
                                            <livewire:admin.cities.delete-city :city="$city"
                                                wire:key="city-delete-{{ $city->id }}" />
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
