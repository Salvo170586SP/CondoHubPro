<div>
    <flux:modal.trigger name="create-city" class="w-full" wire:click="resetForm">
        <flux:button icon="plus" variant="filled">
            Crea
        </flux:button>
    </flux:modal.trigger>
    <flux:modal name="create-city" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Crea</flux:heading>
            </div>
            <flux:input wire:model="name_city" label="Città" placeholder="Es: Roma" />
            <flux:input wire:model="name_prov" label="Provincia" placeholder="Es: RM" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="createCity">Salva</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
