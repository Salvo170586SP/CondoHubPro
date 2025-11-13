<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/diary">Mia Agenda</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli Nota</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Mia Agenda</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/diary">
                Torna Indietro
            </flux:button>
        </div>

        <div wire:key="notice-{{ $diary->id }}-{{ str()->random(10) }}"
            class="w-full bg-zinc-100/40 dark:bg-zinc-700 border dark:border-zinc-600 rounded-lg mb-5 shadow">
            <div class="h-full flex justify-between items-center">
                <div class="w-full h-full flex flex-col gap-1">
                    @if ($diary->is_important)
                    <div
                        class="flex justify-center items-center text-sm font-medium py-1 m-1 bg-red-100 dark:bg-red-800/40 border border-red-300 dark:border-red-700 dark:text-red-300 text-red-500 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0"
                            stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                        </svg>
                        Importante
                    </div>
                    @endif
                    <div class="border-b dark:border-zinc-500 flex justify-between items-center  p-2">
                        <div>
                            <div class="font-medium text-xs capitalize text-zinc-500 dark:text-zinc-300">{{
                                $diary->getYear($diary->date)
                                }}
                            </div>
                            <div class="font-medium text-3xl capitalize">{{ $diary->getDate($diary->date) }}</div>
                        </div>
                        <div class="flex  gap-2">

                            <flux:button icon="pencil" variant="filled" size="sm" wire:navigate
                                href="/admin/diary/{{$diary->id}}/edit">Modifica</flux:button>
                            <livewire:admin.diary.delete-diary wire:key="{{ $diary->id }}-{{ str()->random(10) }}"
                                :d="$diary" />
                        </div>
                    </div>
                    <div class=" min-h-[600px] px-2 py-4">
                        <h3 class="font-medium text-lg capitalize">{{ $diary->title }}</h3>
                        <p class="h-full text-zinc-500 dark:text-zinc-300">{{$diary->content}}</p>
                    </div>
                    <div class="px-2 py-3 border-t dark:border-zinc-500 text-zinc-400 text-sm">
                        Categoria:
                        @if($diary->category)
                        @foreach($categories as $c)
                        @if($diary->category == $c['id'])
                        <span class="font-medium text-sm {{ $c['color'] ?? '-'}} rounded-lg px-2 py-1 ms-3">{{
                            $c['label'] }}</span>
                        @endif
                        @endforeach
                        @else
                        -
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>