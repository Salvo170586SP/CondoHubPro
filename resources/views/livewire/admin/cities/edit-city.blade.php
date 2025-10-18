<div>
    <flux:modal.trigger name="edit-city-[{{ $city->id }}]"  wire:click="resetForm">
        <flux:button icon="pencil" variant="filled" >
        </flux:button>
    </flux:modal.trigger>
    <flux:modal name="edit-city-[{{ $city->id }}]" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifica
                </flux:heading>
            </div>
            <flux:input wire:model="name_city" label="Città" placeholder="Es: Roma" />
            <flux:input wire:model="name_prov" label="Provincia" placeholder="Es: RM" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="editCity({{ $city->id }})">Modifica
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
