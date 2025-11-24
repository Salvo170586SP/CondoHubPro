<div>
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/condominiums">Condomini</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Dettagli</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">@role('admin') Dettagli Condominio @else Il Mio Condominio @endrole</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/condominiums">
                Torna Indietro
            </flux:button>
        </div>

        <div class="w-full h-full flex gap-3 mb-3">
            <div
                class="w-[400px] max-h-[500px] p-5 flex-col items-center space-y-3 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Nome:</div>
                    {{ $condominium->name }}
                </div>
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Indirizzo:</div>
                    {{ $condominium->address }}
                </div>
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Cap:</div>
                    {{ $condominium->cap }}
                </div>

                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Città:</div>
                    {{ $condominium->city->name_city }}
                </div>
                <div class="text-sm">
                    <div class="text-sm font-medium">Creato il:</div>
                    {{ $condominium->getDate($condominium->created_at) }}
                </div>

                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Numero Appartamenti:</div>
                    {{ $condominium->apartments->count() }}
                </div>
                <div class="text-sm capitalize">
                    <div class="text-sm font-medium">Amministratore:</div>
                    @if ($condominium->administrator)
                    {{ $condominium->administrator->getFullName() }}
                    @else
                    -
                    @endif
                </div>

                <div class="w-full space-y-3 border-t dark:border-zinc-500 py-3">
                    <flux:button wire:navigate href="/admin/condominiums/{{ $condominium->id }}/feedbacks"
                        class="w-full">
                        Segnalazioni <span
                            class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-600 text-white h-5 w-5 rounded-lg ms-2">{{
                            $feedbooksCount }}</span></flux:button>

                    <flux:button wire:navigate href="/admin/notices-board/{{ $condominium->id }}" class="w-full">
                        Bacheca <span
                            class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-600 text-white h-5 w-5 rounded-lg ms-2">{{
                            $noticesBoardCount }}</span></flux:button>
                </div>
            </div>

            <div
                class="w-full h-[700px] p-5 rounded-lg shadow text-gray-900 dark:text-white bg-zinc-100/50 border dark:border-zinc-600 dark:bg-zinc-700/50">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-bold mb-5 flex items-center">Appartamenti <span
                            class="inline-flex items-center justify-center font-medium text-sm bg-black dark:bg-zinc-600 text-white h-5 w-5 rounded-lg ms-2">{{
                            $apartmentsCount }}</span>
                    </h2>
                    @role('admin|amministratore')
                    <flux:button icon="plus" variant="filled" wire:navigate
                        href="/admin/condominiums/{{ $condominium->id }}/apartments/add">
                        Crea
                    </flux:button>
                    @endrole
                </div>

                <livewire:admin.condominiums.table-apartments :condominium="$condominium" />
            </div>
        </div>
    </div>
</div>