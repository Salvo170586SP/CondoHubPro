<div>
    <flux:modal.trigger name="edit-notice-[{{ $notice->id }}]">
        <flux:button icon="pencil"  size="sm" variant="filled">
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
            <flux:checkbox label="Importante" wire:model="is_important" />

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
              <x-input-file model="url_pdf" text="Carica File" />
 
            @if (optional($notice->document)->url_pdf)
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    File attuale:
                    <div class="underline text-blue-600 dark:text-blue-300">
                        {{ $notice->document->name_file ?? basename($notice->document->url_pdf) }}
                    </div>
                </div>
            @endif
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="filled" wire:click="submit">Modifica</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
