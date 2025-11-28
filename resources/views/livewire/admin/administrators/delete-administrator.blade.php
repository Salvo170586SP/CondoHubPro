<div>
    <flux:modal.trigger name="delete-administrator-[{{ $administrator->id }}]">
        <flux:button icon="trash" size="sm" variant="primary" color="red">Elimina
        </flux:button>
    </flux:modal.trigger>
    <flux:modal name="delete-administrator-[{{ $administrator->id }}]" class="md:w-96 bg-white/80 backdrop-blur-lg">
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
                    <flux:button type="submit" variant="danger" wire:click="deleteAdministrator">Elimina
                    </flux:button>
                </div>
            </div>
        </div>
    </flux:modal>
</div>
