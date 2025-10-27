<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Amministratori</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
                <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
                <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Amministratori</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/admin/administrators/create">
                Crea
            </flux:button>
        </div>
        <div class="w-100 my-3">
            <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
        </div>
        @if ($administrators && $administrators->count() > 0)
            <div class="overflow-x-auto">
                <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                        <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                </th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Nome e Cognome
                                </th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Telefono</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-3 text-center text-xs uppercase tracking-wider">
                                    Condomini Affiliati</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                    Creato il</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                            @foreach ($administrators as $administrator)
                                <tr wire:key="administrator-{{ $administrator->id }}-{{ str()->random(10) }}"
                                    class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($administrator->img_user)
                                            <flux:avatar src="{{ asset('storage/' . $administrator->img_user) }}" />
                                        @else
                                            <flux:avatar
                                                name="{{ $administrator->name . ' ' . $administrator->surname }}" />
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $administrator->name . ' ' . $administrator->surname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $administrator->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $administrator->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-center">
                                            <span
                                                class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-600 text-white h-5 w-5 rounded-lg ms-2">
                                                {{ $administrator->condominiums->count() }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $administrator->getDate($administrator->created_at) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-end gap-2">
                                            <flux:button icon="eye" variant="filled" wire:navigate
                                                href="/admin/administrators/{{ $administrator->id }}/show">
                                            </flux:button>
                                            <flux:button icon="pencil" variant="filled" wire:navigate
                                                href="/admin/administrators/{{ $administrator->id }}/edit">
                                            </flux:button>
                                            <livewire:admin.administrators.delete-administrator :administrator="$administrator"
                                                wire:key="administrator-delete-{{ $administrator->id }}-{{ str()->random(10) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mx-1 mt-5">
                    {{ $administrators->links('vendor.livewire.tailwind') }}
                </div>
            </div>
        @else
            <div class="font-medium italic w-full text-center mt-10">non ci sono elementi</div>
        @endif
    </div>
</div>
