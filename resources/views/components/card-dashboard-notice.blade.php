@props([
    'items' => null,
    'types' => null,
])

<div class="h-[250px] shadow rounded-lg   p-5 bg-zinc-50 border dark:border-zinc-600 dark:bg-zinc-700/50">
    <div class="flex justify-between items-center">
        {{ $slot }}
    </div>

    <div class="mt-8">
        <ul class="space-y-3">
            @if ($items && $items->isNotEmpty())
                @foreach ($items as $item)
                    <li class="bg-zinc-100 dark:bg-zinc-700 p-2 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div class="space-x-15">
                                <span class="capitalize font-medium text-sm">
                                    <span class="text-zinc-500 dark:text-zinc-400">Titolo:</span>
                                    {{ $item->title }}
                                </span>
                                <span class="capitalize font-medium text-sm">
                                    <span class="text-zinc-500 dark:text-zinc-400">Avviso del:</span>
                                    {{ $item->getDate($item->created_at) }}
                                </span>
                                @foreach ($types as $type)
                                    @if ($item->type == $type['id'])
                                        <span class="{{ $type['color'] }} rounded-lg px-2 py-1  text-white capitalize font-medium text-sm">
                                            {{ $type['label'] }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            <flux:button variant="filled" size="sm" wire:navigate
                                href="/admin/condominiums/{{ $item->condominium->id }}/show">
                                Visualizza</flux:button>
                        </div>
                    </li>
                @endforeach
            @else
                <li class="font-medium">Nessun residente disponibile</li>
            @endif
        </ul>
    </div>
</div>
