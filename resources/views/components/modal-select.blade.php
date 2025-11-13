@props([
    'selected',
])

<div class="border border-zinc-200 dark:border-zinc-600  bg-white dark:bg-zinc-700 w-[350px] flex justify-between items-center   rounded-lg py-2 px-4">
    <div class="text-zinc-600 dark:text-zinc-300 font-medium border-e pe-2">
        <span class="font-bold me-2">{{ count($selected) }}</span> selezionati
    </div>

    <div>
        <flux:modal.trigger name="delete-profile">
            <flux:button size="sm" icon="trash" variant="danger">Elimina Selezionati
            </flux:button>
        </flux:modal.trigger>

        <flux:modal name="delete-profile" class="md:w-96">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Attenzione!</flux:heading>
                    <flux:text class="mt-2">Sei sicuoro di eliminare i selezionati?</flux:text>
                </div>

                <div class="flex">
                    <flux:spacer />
                    <flux:button wire:click="deleteSelected" variant="danger">Elimina</flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>