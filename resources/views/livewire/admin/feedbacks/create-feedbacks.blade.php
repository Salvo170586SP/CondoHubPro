<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{ $condominium->id }}/show">Dettagli
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums/{{ $condominium->id }}/feedbacks">Segnalazioni
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Crea</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Invia Segnalazione</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate
                href="/admin/condominiums/{{ $condominium->id }}/feedbacks">
                Torna Indietro
            </flux:button>
        </div>
        <div class="overflow-x-auto">
            <div
                class="min-w-full border dark:border-zinc-600 rounded-lg p-5 space-y-3 bg-zinc-100/50 dark:bg-zinc-700/50">
                <div class="grid grid-cols-2 gap-5">
                    <flux:select wire:model="priority" label="Priorità">
                        <flux:select.option>-</flux:select.option>
                        @foreach ($priorities as $priority)
                            <flux:select.option value="{{ $priority['id'] }}" wire:key="{{ $priority['id'] }}">
                                {{ $priority['label'] }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:input wire:model="title" label="Titolo" />
                </div>
                <flux:textarea wire:model="description" label="Descrizione" rows="10" />

                <div class="flex justify-end mt-10">
                    <flux:button icon="check" variant="filled" wire:click="submit">
                        Crea
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>
