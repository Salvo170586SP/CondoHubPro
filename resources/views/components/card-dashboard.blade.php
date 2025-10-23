@props([
    'items' => null,
    'urlAll' => null,
    'urlItem' => null,
])

<div class="h-[250px] shadow rounded-lg border p-5 bg-zinc-50">
    <div class="flex justify-between items-center">
        {{ $slot }}
        @if ($urlAll)
            <flux:button variant="primary" size="sm" wire:navigate href="{{ $urlAll }}">Visualizza Tutti
            </flux:button>
        @endif
    </div>

    <div class="mt-8">
        <ul class="space-y-3">
            @if ($items && $items->isNotEmpty())
                @foreach ($items->take(3) as $item)
                    <li class="bg-zinc-100 p-2 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div class="space-x-15">
                                <span class="capitalize font-medium text-sm">
                                    <span class="text-zinc-500">Nome:</span>
                                    {{ $item->getFullName() }}
                                </span>
                                <span class="capitalize font-medium text-sm">
                                    @if ($item->apartment)
                                        <span class="text-zinc-500">Condominio:</span>
                                        {{ $item->apartment->condominium->name }}
                                    @else
                                        <span class="text-zinc-500">Condomini gestiti:</span>
                                        {{ $item->condominiums->count() }}
                                    @endif
                                </span>
                            </div>
                            @php
                                $itemUrl = $urlItem
                                    ? str_replace('{id}', $item->id, $urlItem)
                                    : "/admin/condominiums/{$item->id}/show";
                            @endphp
                            @if ($itemUrl)
                                <flux:button variant="primary" size="sm" wire:navigate href="{{ $itemUrl }}">
                                    Visualizza</flux:button>
                            @endif
                        </div>
                    </li>
                @endforeach
            @else
                <li class="font-medium">Nessun residente disponibile</li>
            @endif
        </ul>
    </div>
</div>
