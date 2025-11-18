<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/archive">Archivio</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Archivi del condominio {{$condominium->name}}</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
            <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
            <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Archivio del Condominio {{$condominium->name}}</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/archive">
                Torna Indietro
            </flux:button>
        </div>

        <div class="flex space-x-3 my-5">
            <div class="w-100">
                <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
            </div>
        </div>

        @if ($docs->count() > 0)
        <div class="overflow-x-auto">
            <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                    <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                Nome File</th>
                            <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                Inserito da</th>
                            <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                Formato</th>
                            <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                Inserito il</th>
                            <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                        @foreach ($docs as $document)
                        <tr wire:key="apartment-{{ $document->id }}-{{ str()->random(10) }}"
                            class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                {{ $document->name_file ?? '-' }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                @if($document->uploader)
                                {{ $document->uploader->getFullName() }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if ($document->mime_type)
                                {{ $document->mime_type }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                @if ($document->created_at)
                                {{ $document->getDate($document->created_at) }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex justify-end gap-2">
                                    <flux:dropdown align="start">
                                        <flux:button variant="filled" icon:trailing="ellipsis-horizontal" size="sm" />
                                        <flux:navmenu>
                                            <flux:navmenu.item download href="{{ '/storage/' . $document->url_pdf }}"
                                                icon="arrow-down-tray">Scarica</flux:navmenu.item>
                                            <flux:navmenu.item target="_blanck"
                                                href="{{ '/storage/' . $document->url_pdf }}" icon="eye">Vedi
                                            </flux:navmenu.item>
                                            <flux:modal.trigger name="delete-doc-[{{ $document->id }}]">
                                                <flux:navmenu.item icon="trash" variant="danger">Elimina
                                                </flux:navmenu.item>
                                            </flux:modal.trigger>
                                            <flux:modal name="delete-doc-[{{ $document->id }}]" class="md:w-96">
                                                <div class="space-y-6">
                                                    <div>
                                                        <flux:heading size="lg">Attenzione!
                                                        </flux:heading>
                                                        <flux:text size="md">Sei sicuro di eliminare l'elemento?
                                                        </flux:text>
                                                    </div>
                                                    <div class="flex">
                                                        <flux:spacer />
                                                        <div class="space-x-3">
                                                            <flux:modal.close>
                                                                <flux:button variant="ghost">Cancel</flux:button>
                                                            </flux:modal.close>
                                                            <flux:button type="submit" variant="danger"
                                                                wire:click="deleteDocument({{ $document->id }})">
                                                                Elimina
                                                            </flux:button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </flux:modal>
                                        </flux:navmenu>
                                    </flux:dropdown>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-1 mt-5">
                {{ $docs->links('vendor.livewire.tailwind') }}
            </div>
        </div>
        @else
        <div
            class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
            Non ci sono elementi
        </div>
        @endif

    </div>
</div>