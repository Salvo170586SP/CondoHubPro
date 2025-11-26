<div>
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-bold flex items-center">Resoconto Pagamenti</h2>
        @role('admin|amministratore')
        @if($condominiumPayments->count())
        <flux:button wire:click="generatePdf" icon="arrow-down-on-square" variant="filled">
            Genera PDF
        </flux:button>
        @endif
        @endrole
    </div>

    <div class="my-3">
        {{$condominiumPayments->links('vendor.livewire.tailwind')}}
    </div>
    <div class="overflow-x-auto">
        <div class="min-w-full border dark:border-zinc-600 rounded-lg">
            <table class="min-w-full bg-white rounded-lg overflow-hidden dark:bg-zinc-900">
                <thead class="bg-gray-100 dark:bg-zinc-700 text-gray-500 dark:text-white font-medium">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Residente</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Appartamento
                        </th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Piano</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Interno</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Data Pagamento
                        </th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Importo</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Stato</th>
                        <th class="px-4 py-3 text-left text-xs tracking-wider uppercase">Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                    @forelse($condominiumPayments as $payment)
                    <tr wire:key="payment-{{ $payment->id }}"
                        class="bg-white hover:bg-gray-50 dark:bg-zinc-800 hover:dark:bg-zinc-900 text-gray-900 dark:text-white text-sm">
                        <td class="px-4 py-4 whitespace-nowrap capitalize">
                            {{ $payment->resident ? $payment->resident->getFullName() : '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $payment->resident->apartments->first()->name ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-center">
                            {{ $payment->resident->apartments->first()->floor ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-center">
                            {{ $payment->resident->apartments->first()->unit_number ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            {{ $payment->getDate($payment->date) }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap font-semibold">
                            € {{ number_format($payment->price, 2, ',', '.') }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap font-medium">
                            @if($payment->is_pay)
                            <span
                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Pagato
                            </span>
                            @else
                            <span
                                class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Non Pagato
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <x-modal-note :item="$payment" />
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8"
                            class="px-4 py-5 text-center text-sm italic bg-zinc-50 text-gray-400 dark:text-gray-400 font-medium">
                            Nessun pagamento registrato per questo condominio
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>