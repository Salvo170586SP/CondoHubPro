@props([
'item',
])

<flux:modal.trigger name="note-payment-[{{ $item->id }}]">
    <flux:button icon="chat-bubble-left-ellipsis" size="sm" variant="filled">
    </flux:button>
</flux:modal.trigger>
<flux:modal name="note-payment-[{{ $item->id }}]" class="md:w-96">
    <div class="space-y-6 max-h-100 overflow-y-auto ">
        <div class="break-words whitespace-normal my-5">
            <flux:text size="md">
                @if($item->note)
                {{ $item->note }}
                @else
                Nessuna nota
                @endif
            </flux:text>
        </div>
        <div class="flex">
            <flux:spacer />
            <div class="space-x-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </div>
</flux:modal>