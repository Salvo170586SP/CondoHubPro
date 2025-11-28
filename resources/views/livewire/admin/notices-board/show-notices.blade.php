<div>
    <flux:modal.trigger name="detail-notice-[{{ $notice->id }}]">
        <flux:button icon="eye" size="sm" variant="filled">
            Leggi
        </flux:button>
    </flux:modal.trigger>
    <flux:modal name="detail-notice-[{{ $notice->id }}]" class="md:w-96 bg-white/80 backdrop-blur-lg">
        <div class="space-y-6">
            <div class="space-y-6 max-h-100 overflow-y-auto ">
                <flux:heading size="md">
                    {{ $notice->title }}
                </flux:heading>
                <div class="break-words whitespace-normal my-5">
                    <flux:text size="sm">
                        {{ $notice->description }}
                    </flux:text>
                </div>
            </div>
            <div class="flex">
                <flux:spacer />
                <div class="space-x-3">
                    <flux:modal.close>
                        <div class="flex items-center gap-3">
                            <flux:button variant="ghost">Cancel</flux:button>
                        </div>
                    </flux:modal.close>
                </div>
            </div>
        </div>
    </flux:modal>
</div>