<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/administrators">Amminstratori</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Modifica</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Amminsitratori / Modifica</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/administrators">
                Torna Indietro
            </flux:button>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full border dark:border-zinc-600 bg-zinc-100/30 dark:bg-zinc-700/50 rounded-lg p-5 space-y-3">
                <flux:input wire:model="name" label="Nome" />
                <flux:input wire:model="surname" label="Cognome" />
                <flux:input wire:model="phone_number" label="Telefono" />
                <flux:input type="file" wire:model="img_user" label="Allega Foto" />
                <div class="flex justify-end mt-10">
                    <flux:button icon="check" variant="filled" wire:click="editAdministrator">
                        Modifica
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>
