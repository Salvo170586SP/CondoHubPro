<div>
    <flux:modal.trigger name="delete-notice-[{{ $notice->id }}]">
        <flux:button icon="trash" variant="filled">
            Elimina
        </flux:button>
    </flux:modal.trigger>
    <flux:modal name="delete-notice-[{{ $notice->id }}]" class="md:w-96">
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
                    <flux:button type="submit" variant="danger" wire:click="deleteNotice">Elimina
                    </flux:button>
                </div>
            </div>
        </div>
    </flux:modal>
</div>
