<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/payments">Pagamenti</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli Fattura</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Dettagli Fattura</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/payments">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full flex gap-3">
            <div
                class="w-[400px] h-full p-5 rounded-lg shadow border dark:border-zinc-600 bg-zinc-100/50 dark:bg-zinc-700/50">
                <div class="space-y-3 border-b ">
                    <div class="text-sm">
                        <div class="font-medium">Stato Pagamento:</div>
                        {{ $payment->is_pay ? 'Pagato' : 'Non Pagato' }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Data pagamento:</div>
                        {{ $payment->getDate($payment->date) }}
                    </div>

                    <div class="text-sm my-3">
                        @if($payment->note)
                        <x-modal-note :item="$payment" />
                        @else
                        <flux:button size="sm" icon="no-symbol" variant="filled"></flux:button>
                        @endif
                    </div>
                </div>
                <div class="my-3 border-b ">
                    <div class="space-y-3 my-5  text-gray-900 dark:text-white">
                        <div class="text-sm">
                            <div class="font-medium">Nome e Cognome:</div>
                            {{ $payment->resident->getFullName() }}
                        </div>
                        <div class="text-sm">
                            <div class="font-medium">Telefono:</div>
                            {{ $payment->resident->phone_number }}
                        </div>
                        <div class="text-sm">
                            <div class="font-medium">Email:</div>
                            {{ $payment->resident->email }}
                        </div>
                    </div>
                </div>
                <div class="space-y-3 my-5 text-gray-900 dark:text-white">
                    <div class="text-sm">
                        <div class="font-medium">Condominio:</div>
                        {{ $payment->resident->apartment->condominium->name ?? '-' }}
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Indirizzo:</div>
                        @if($payment->resident && $payment->resident->apartment &&
                        $payment->resident->apartment->condominium)
                        {{ $payment->resident->apartment->condominium->address }}
                        @else
                        -
                        @endif
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Cap:</div>
                        @if($payment->resident && $payment->resident->apartment &&
                        $payment->resident->apartment->condominium)
                        {{ $payment->resident->apartment->condominium->cap }}
                        @else
                        -
                        @endif
                    </div>
                    <div class="text-sm">
                        <div class="font-medium">Cap:</div>
                        @if($payment->resident && $payment->resident->apartment &&
                        $payment->resident->apartment->condominium->administrator)
                        {{ $payment->resident->apartment->condominium->administrator->getFullName() }}
                        @else
                        -
                        @endif
                    </div>
                </div>
                <div class="text-2xl text-end">
                    <div class="font-medium">Totale:</div>
                    {{ $payment->price }}€
                </div>

            </div>


            <div class="w-full p-5 rounded-lg shadow border dark:border-zinc-600 bg-zinc-100/50 dark:bg-zinc-700/50">
                @if($payment->document && $payment->document->url_pdf)
                <div class="w-full h-full">
                    <embed src="{{asset('storage/'.$payment->document->url_pdf )}}" type="application/pdf"
                        class="w-full h-full rounded-lg" frameborder="0"></embed>
                </div>
                @else
                <div class="h-full flex flex-col justify-center items-center text-zinc-400 font-medium">
                    Non c'è ancora una fattura

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>

                </div>
                @endif
            </div>
        </div>
    </div>
</div>