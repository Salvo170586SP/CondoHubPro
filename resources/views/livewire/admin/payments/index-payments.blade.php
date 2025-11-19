<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Pagamenti</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
            <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
            <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Quote Pagamenti</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/admin/payments/create">
                Crea
            </flux:button>
        </div>

        <div class="flex items-center justify-between my-3 h-15">

            <div class="flex items-center justify-between">
                <div class="w-full flex items-center gap-3">
                    <div class="w-[350px]">
                        <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
                    </div>
                    <div class="w-50">
                        <flux:input wire:model.live="dateSearch" type="date" max="2999-12-31" />
                    </div>
                    <div class="w-[150px]">
                        <flux:checkbox wire:model.live="search_pay" label="Filtra Pagati" />
                    </div>
                </div>
                <flux:button wire:click="resetFilter" variant="filled">Reset filtri</flux:button>
            </div>

            @role('admin|amministratore')
            @if (count($selected) > 0)
            <x-modal-select :selected="$selected" />
            @endif
            @endrole
        </div>

        @if($payments->count() > 0)
        <div class="mb-5">
            {{ $payments->links('vendor.livewire.tailwind') }}
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full border dark:border-zinc-600 rounded-lg">
                <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                    <thead class="bg-gray-100 text-xs dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                        <tr>
                            @role('admin|amministratore')
                            <th class="px-4 py-3 text-left text-xs uppercase tracking-wider">
                                <flux:checkbox type="checkbox" wire:model.live="areAllSelected"
                                    class="form-checkbox h-4 w-4" />
                            </th>
                            @endrole
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Residente
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Condominio
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Fattura
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Quota
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Note
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                                Data Pagamento
                            </th>
                            <th class="px-4 py-3 text-cenyter tracking-wider uppercase">
                                Pagato
                            </th>
                            <th class="px-4 py-3 text-left tracking-wider uppercase">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                        @foreach($payments as $payment)
                        <tr wire:key="payment-{{ $payment->id }}-{{ str()->random(10) }}"
                            class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                            @role('admin|amministratore')
                            <td class="px-4 py-4 whitespace-nowrap text-sm">
                                <flux:checkbox type="checkbox" wire:model.live="selected"
                                    wire:key="select-{{ $payment->id }}" value="{{ $payment->id }}"
                                    class="form-checkbox h-4 w-4" />
                            </td>
                            @endrole
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $payment->resident->getFullName() ?? '-' }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap capitalize">
                                {{ $payment->resident->apartment->condominium->name ?? '-' }}
                             </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($payment->document && $payment->document->url_pdf)
                                <span class="px-3 py-1 bg-green-500 text-white font-medium rounded-lg">Emanata</span>
                                @else
                                <span class="px-3 py-1 bg-red-400 text-white font-medium rounded-lg">Non Presente</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $payment->price }}€
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($payment->note)
                                <x-modal-note :item="$payment" />
                                @else
                                <flux:button size="sm" icon="no-symbol" variant="filled"></flux:button>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $payment->getDate($payment->date) }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex justify-center">
                                    @if($payment->is_pay)
                                    <span class="px-3 py-1 bg-slate-400 text-white font-medium rounded-lg">Pagato</span>
                                    @else
                                    <span class="px-3 py-1 bg-red-400 text-white font-medium rounded-lg">Non
                                        Pagato</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex justify-end gap-2">
                                    <flux:button icon="eye" size="sm" variant="filled" wire:navigate
                                        href="/admin/payments/{{ $payment->id }}/show">Dettagli
                                    </flux:button>
                                    <flux:button icon="pencil" size="sm" variant="filled" wire:navigate
                                        href="/admin/payments/{{ $payment->id }}/edit">Modifica
                                    </flux:button>
                                    <flux:modal.trigger name="delete-payment-[{{ $payment->id }}]">
                                        <flux:button icon="trash" size="sm" variant="danger">
                                            Elimina
                                        </flux:button>
                                    </flux:modal.trigger>
                                    <flux:modal name="delete-payment-[{{ $payment->id }}]" class="md:w-96">
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
                                                    <flux:button type="submit" variant="danger"
                                                        wire:click="deletePayment({{$payment->id}})">Elimina
                                                    </flux:button>
                                                </div>
                                            </div>
                                        </div>
                                    </flux:modal>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
            <p>Nessuna quota condominiale.</p>
        </div>
        @endif
    </div>
</div>