<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{ $condominium->id }}/show">Dettagli
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Segnalazioni</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Segnalazioni</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate
                href="/admin/condominiums/{{ $condominium->id }}/show">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full grid grid-cols-3 gap-5 mb-5">
            <div
                class="h-full p-5 flex-col items-center space-y-3 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                <div class="flex justify-between">
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Nome:</div>
                        {{ $condominium->name }}
                    </div>
                    <div class="text-sm capitalize">
                        <div class="text-sm font-medium">Indirizzo:</div>
                        {{ $condominium->address }}
                    </div>
                </div>

                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Cap:</div>
                    {{ $condominium->cap }}
                </div>
            </div>

            <div
                class="h-full p-5 flex-col items-center space-y-3 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">

                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Città:</div>
                    {{ $condominium->city->name_city }}
                </div>
                <div class="text-sm">
                    <div class="text-sm font-medium">Creato il:</div>
                    {{ $condominium->getDate($condominium->created_at) }}
                </div>
            </div>

            <div
                class="p-5 flex-col items-center space-y-3 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                <div class="text-sm capitalize flex ju">
                    <div class="text-sm font-medium">Numero Appartamenti:</div>
                    <span
                        class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-900 text-white h-5 w-5 rounded-lg ms-3">
                        {{ $condominium->apartments->count() }} </span>
                </div>
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Amministratore:</div>
                    @if ($condominium->administrator)
                        {{ $condominium->administrator->getFullName() }}
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>


        <div class="w-full flex gap-5">
            <div class="w-full">
                <div
                    class="w-full p-5 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-lg font-bold mb-5 flex items-center">Segnalazioni <span
                                class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-900 text-white p-2 h-5 w-5 rounded-lg ms-2">{{ $feedbacks->count() }}
                            </span>
                        </h2>
                        <flux:button icon="plus" variant="filled" wire:navigate
                            href="/admin/condominiums/{{ $condominium->id }}/feedbacks/create">
                            Invia Segnalazione
                        </flux:button>
                    </div>

                    <div class="w-full h-[10px] mb-7">
                        @if (session('messageFeedback'))
                            <flux:badge color="zinc" class="w-full p-2">{{ session('messageFeedback') }}
                            </flux:badge>
                        @elseif(session('errorFeedback'))
                            <flux:badge color="red" class="w-full p-2">{{ session('errorFeedback') }}</flux:badge>
                        @endif
                    </div>

                    <div class="flex space-x-3 my-3">
                        <div class="w-100">
                            <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
                        </div>

                        <div class="flex items-center space-x-3">
                            <flux:select wire:model.live="filterPriority" id="priority" placeholder="filtra priorità">
                                <flux:select.option value="">Mostra Tutti</flux:select.option>
                                @foreach ($priorities as $priority)
                                    <flux:select.option value="{{ $priority['id'] }}"
                                        wire:key="{{ $priority['id'] }}">
                                        {{ $priority['label'] }}</flux:select.option>
                                @endforeach
                            </flux:select>
                        </div>
                    </div>
                    @if ($feedbacks && $feedbacks->count() > 0)
                        <div class="overflow-x-auto">
                            <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                                <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                                    <thead
                                        class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                                Titolo</th>
                                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                                Creato da</th>
                                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                                Priorità</th>
                                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                                Creato il</th>
                                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                                        @foreach ($feedbacks as $feedback)
                                            <tr wire:key="feedback-{{ $feedback->id }}-{{ str()->random(10) }}"
                                                class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                                    {{ $feedback->title }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                                    {{ $feedback->creator->getFullName() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @foreach ($priorities as $priority)
                                                        @if ($feedback->priority == $priority['id'])
                                                            <span
                                                                class="{{ $priority['color'] }} px-3 py-1 text-white rounded-lg">{{ $priority['label'] }}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $feedback->getDate($feedback->created_at) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex justify-end gap-2">
                                                        <flux:button icon="eye" variant="filled" wire:navigate
                                                            href="/admin/condominiums/{{ $condominium->id }}/feedbacks/{{ $feedback->id }}/show">
                                                        </flux:button>
                                                        <flux:button icon="pencil" variant="filled" wire:navigate
                                                            href="/admin/condominiums/{{ $condominium->id }}/feedbacks/{{ $feedback->id }}/edit">
                                                        </flux:button>
                                                        <livewire:admin.feedbacks.delete-feedbacks :condominium="$condominium"
                                                            :feedback="$feedback"
                                                            wire:key="feedback-delete-{{ $condominium->id }}-{{ $feedback->id }}-{{ str()->random(10) }}" />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mx-1 mt-5">
                                {{ $feedbacks->links('vendor.livewire.tailwind') }}
                            </div>
                        </div>
                    @else
                        <div class="w-full text-center font-medium text-sm dark:text-white dark:bg-zinc-500/40 text-zinc-500 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
                            Non ci sono elementi
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
