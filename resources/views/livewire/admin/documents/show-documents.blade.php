<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Archivio</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
                <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
                <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>



        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">File in Archivio</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/archive">
                Torna Indietro
            </flux:button>
        </div>

        <div class="flex space-x-3 my-3">
            <div class="w-100">
                <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
            </div>
        </div>

        <div class="w-full my-5 grid grid-cols-5 gap-2">

            @foreach ($docs as $document)
                <div wire:key="doc-{{ $document->id }}-{{ $condominium->id }}-{{ str()->random(10) }}"
                    class="max-w-[300px] h-[200px]">
                    <div
                        class="w-full h-full rounded-lg border bg-zinc-50 hover:bg-zinc-100 cursor-pointer flex flex-col justify-center items-end p-1">

                        <flux:dropdown align="start">
                            <flux:button variant="filled" icon:trailing="chevron-down" size="sm" />
                            <flux:navmenu>
                                <flux:navmenu.item download href="{{ '/storage/' . $document->url_pdf }}"
                                    icon="arrow-down-tray">Scarica</flux:navmenu.item>
                                <flux:navmenu.item target="_blanck" href="{{ '/storage/' . $document->url_pdf }}"
                                    icon="eye">Vedi</flux:navmenu.item>
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
                                                    wire:click="deleteDocument({{ $document->id }})">Elimina
                                                </flux:button>
                                            </div>
                                        </div>
                                    </div>
                                </flux:modal>

                                <flux:modal.trigger name="info-doc-[{{ $document->id }}]">
                                    <flux:navmenu.item icon="information-circle" variant="danger">Info
                                    </flux:navmenu.item>
                                </flux:modal.trigger>
                                <flux:modal name="info-doc-[{{ $document->id }}]" class="md:w-96">
                                    <div class="space-y-6">
                                        <div>
                                            <flux:heading size="lg">Info
                                            </flux:heading>
                                            <flux:text size="md">
                                                <div class="flex-col mt-2 text-sm">
                                                    <div>
                                                        Caricato da: {{ $document->uploader->getFullName() }}
                                                    </div>
                                                    <div>
                                                        Caricato il: {{ $document->getDate($document->created_at) }}
                                                    </div>
                                                    <div>
                                                        Formato del file: {{ $document->mime_type }}
                                                    </div>
                                                </div>
                                            </flux:text>
                                        </div>
                                        <div class="flex">
                                            <flux:spacer />
                                            <div class="space-x-3">
                                                <flux:modal.close>
                                                    <flux:button variant="ghost">Chiudi</flux:button>
                                                </flux:modal.close>
                                            </div>
                                        </div>
                                    </div>
                                </flux:modal>
                            </flux:navmenu>
                        </flux:dropdown>

                        <div class="w-full h-[150px] flex flex-col justify-around items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-20 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <div class="flex justify-center text-xs">
                                Caricato da
                                <span class="text-xs font-medium inline-block ms-1">
                                    {{ $document->uploader->getFullName() }}
                                </span>
                            </div>
                        </div>
                        <div class="w-full h-[50px] border-t border-white flex justify-center items-center">
                            {{ $document->name_file }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($docs->count() < 1)
            <div
                class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
                Non ci sono file in questo archivio</div>
        @endif
    </div>
</div>
