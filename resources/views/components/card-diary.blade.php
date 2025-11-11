@props([
'd',
'categories'
])

<div wire:key="notice-{{ $d->id }}-{{ str()->random(10) }}"
    class="w-full bg-zinc-100/40 border dark:border-zinc-600 rounded-lg mb-5 shadow">
    <div class="flex justify-between items-center">
        <div class="w-full flex flex-col gap-1">
            @if ($d->is_important)
            <div
                class="flex justify-center items-center font-medium py-1 m-1 bg-red-100 border border-red-600 text-red-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0"
                    stroke="currentColor" class="size-4 me-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
                Importante
            </div>
            @endif
            <div class="border-b flex justify-between items-center  p-2">
                <div>
                    <div class="font-medium text-xs capitalize text-zinc-500">{{ $d->getYear($d->date) }}
                    </div>
                    <div class="font-medium text-3xl capitalize">{{ $d->getDate($d->date) }}</div>
                </div>
                <div class="flex  gap-2">
                    <flux:button icon="eye" variant="filled" size="sm" wire:navigate
                        href="/admin/diary/{{$d->id}}/show" />
                    <flux:button icon="pencil" variant="filled" size="sm" wire:navigate
                        href="/admin/diary/{{$d->id}}/edit" />
                    <livewire:admin.diary.delete-diary wire:key="{{ $d->id }}-{{ str()->random(10) }}" :d="$d" />
                </div>
            </div>
            <div class="px-2 py-4">
                <h3 class="font-medium text-lg capitalize">{{ $d->title }}</h3>
                <p class="text-zinc-500">{{str($d->content)->limit(100)}}</p>
            </div>
            <div class="px-2 py-3 border-t text-zinc-400 text-sm">
                Categoria:
                @if($d->category)
                @foreach($categories as $c)
                @if($d->category == $c['id'])
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