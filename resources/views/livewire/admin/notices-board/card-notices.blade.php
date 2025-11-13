<div>
    <div class="w-full h-[20px]">
        @if (!empty($flashMessage))
        <flux:badge color="zinc" class="w-full p-2">{{ $flashMessage }}</flux:badge>
        @elseif (session('messageNotice'))
        <flux:badge color="zinc" class="w-full p-2">{{ session('messageNotice') }}</flux:badge>
        @elseif(session('errorNotice'))
        <flux:badge color="red" class="w-full p-2">{{ session('errorNotice') }}</flux:badge>
        @endif
    </div>
    <div class="w-full h-[80px] flex justify-between items-center">
        <div class="w-100">
            <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
        </div>
        @if ($favoritesCount > 0)
        <flux:button variant="filled" icon="star" class="{{ $is_favorite ? 'border-2 border-gray-800' : null }}"
            wire:click="viewFavorite">
            Preferiti
            <span class="bg-zinc-500 text-white rounded-full inline-block w-5 h-5 ms-3">{{ $favoritesCount }}</span>
        </flux:button>
        @endif
    </div>

    <div class="mb-5">
        {{ $noticesBoard->links('vendor.livewire.tailwind') }}
    </div>
    @forelse ($noticesBoard as $notice)
    <div wire:key="notice-{{ $notice->id }}-{{ str()->random(10) }}"
        class="w-full p-3  border dark:border-zinc-600 rounded-lg space-y-3 mb-5 {{ $notice->is_active ? 'bg-blue-100/60 dark:bg-black/50' : 'bg-white dark:bg-zinc-700' }}">
        <div class="w-full font-semibold text-xs">
            @if ($notice->is_important)
            <div
                class="flex justify-center items-center py-1 bg-red-100 dark:bg-red-800/40 border border-red-300 dark:border-red-700 dark:text-red-300 text-red-500 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4 me-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
                Importante
            </div>
            @endif
        </div>
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <h3 class="font-medium text-lg capitalize">{{ $notice->title }}</h3>
                @if ($notice->document)
                <flux:button href="{{ asset('/storage/' . $notice->document->url_pdf) }}"
                    download="{{$notice->document->name_file}}" icon="arrow-down-tray" variant="filled">
                    Scarica Allegato: <span
                        class="inline-block ms-2 text-blue-600">{{$notice->document->name_file}}</span>
                </flux:button>
                @endif
            </div>


            <div class="flex items-center gap-2">
                <livewire:admin.noticesBoard.show-notices
                    wire:key="{{ $notice->id }}-{{ $condominium->id }}-{{ str()->random(10) }}" :notice="$notice"
                    :condominium="$condominium" />
                @if($notice->creator && auth()->id() == $notice->creator->id || auth()->user()->hasRole('admin'))
                <livewire:admin.noticesBoard.edit-notices
                    wire:key="{{ $notice->id }}-{{ $condominium->id }}-{{ str()->random(10) }}" :notice="$notice"
                    :condominium="$condominium" />
                @endif
                <livewire:admin.noticesBoard.delete-notices
                    wire:key="{{ $notice->id }}-{{ $condominium->id }}-{{ str()->random(10) }}" :notice="$notice"
                    :condominium="$condominium" />
            </div>
        </div>
        <span class="text-sm text-zinc-500">Creato da
            @if($notice->creator)
            {{ $notice->creator->getFullName() }}
            @else
            -
            @endif
        </span>

        <div class="w-full flex justify-between items-center border-t pt-3">
            <div class="w-full flex items-center ">
                <span class="text-sm">Avviso del {{ $notice->getDate($notice->created_at) }}</span>
                @foreach ($types as $type)
                @if ($notice->type == $type['id'])
                <span class="inline-block {{ $type['color'] }} rounded-lg px-3 text-white font-semibold text-sm ms-3">{{
                    $type['label'] }}</span>
                @endif
                @endforeach
            </div>
            @if (! $is_favorite)
            <flux:button variant="filled" wire:click="changeActive({{ $notice->id }})" title="Aggiungi ai preferiti">
                @if (!$notice->is_active)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd"
                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                        clip-rule="evenodd" />
                </svg>
                @endif
            </flux:button>
            @endif
        </div>
    </div>
    @empty
    <div
        class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
        Non ci sono note in bacheca
    </div>
    @endforelse
</div>