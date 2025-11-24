<div>
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/payments">Pagamenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Modifica Quota</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Modifica Quota</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/payments">
                Torna Indietro
            </flux:button>
        </div>
        <div class="overflow-x-auto">
            <div
                class="min-w-full border dark:border-zinc-600 rounded-lg p-5 space-y-3 bg-zinc-100/50 dark:bg-zinc-700/50">
                <div class="grid grid-cols-3 gap-3">
                    <flux:select wire:model="resident_id" label="Residente">
                        <flux:select.option>-</flux:select.option>
                        @foreach ($residents as $resident)
                        <flux:select.option value="{{ $resident->id }}" wire:key="{{ $resident->id }}">
                            {{ $resident->getFullname()}}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:input type="number" wire:model="price" label="Quota" />
                    <flux:input type="date" wire:model="date" label="Data Pagamento" />
                </div>
                <flux:textarea wire:model="note" label="Nota" />
                <div class="space-y-5 mt-5">

                    <div class="font-medium text-sm">
                        @if($payment->document && $payment->document->url_pdf)
                        Fattura Attuale:
                        <a class="text-blue-800 dark:text-blue-300 font-bold ms-2 underline"
                            href="{{asset('storage/'.$payment->document->url_pdf)}}" target="_blanc">{{$payment->document->name_file}}</a>
                        @else
                        Nessuna Fattura Caricata
                        @endif
                    </div>
                    <x-input-file model="url_pdf" text="Carica Fattura" />
                    <flux:checkbox wire:model="is_pay" label="Pagato" />

                </div>

                <div class="flex justify-end mt-10">
                    <flux:button icon="check" variant="filled" wire:click="submit">
                        Modifica
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>