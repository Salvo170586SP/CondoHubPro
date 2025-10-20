<div>
    <flux:modal.trigger name="detail-notice-[{{ $notice->id }}]">
        <flux:button icon="eye" variant="filled">
            Leggi
        </flux:button>
    </flux:modal.trigger>
    <flux:modal name="detail-notice-[{{ $notice->id }}]" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ $notice->title }}
                </flux:heading>

                <flux:text size="sm">
                    {{ $notice->description }}
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
</div>
