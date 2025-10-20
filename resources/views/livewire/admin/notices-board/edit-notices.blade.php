<div>
    <flux:modal.trigger name="edit-notice-[{{ $notice->id }}]">
        <flux:button icon="pencil" variant="filled">
            Modifica
        </flux:button>
    </flux:modal.trigger>
    <flux:modal name="edit-notice-[{{ $notice->id }}]" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifica Nota</flux:heading>
            </div>
            <flux:input label="Titolo" wire:model="title" />
            <flux:textarea label="Descrizione" wire:model="description" />
            <flux:select wire:model="type" label="Tipo">
                <flux:select.option value="">Seleziona</flux:select.option>
                @if (is_array($types) || $types instanceof \Illuminate\Support\Collection)
                    @foreach ($types as $type)
                        <flux:select.option value="{{ $type['id'] }}" wire:key="{{ $type['id'] }}">
                            {{ $type['label'] }}
                        </flux:select.option>
                    @endforeach
                @endif
            </flux:select>
            <flux:input type="file" label="Carica file" wire:model="url_pdf" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="submit">Modifica</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
