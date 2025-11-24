<div>
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item wire:navigate href="/admin/diary">Mia Agenda</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Scrivi Nota</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Scrivi Nota</h2>
            <flux:button icon="arrow-left" variant="filled" wire:navigate href="/admin/diary">
                Torna Indietro
            </flux:button>
        </div>

        <div class="min-w-full border dark:border-zinc-600 rounded-lg p-5 space-y-5 bg-zinc-100/50 dark:bg-zinc-700/50">
            <div class=" pb-5 space-y-5">
                <div class="grid grid-cols-3 gap-3">
                    <flux:input wire:model="title" label="Titolo" />
                    <flux:input type="date" wire:model="date" max="2999-12-31" label="Data" />
                    <flux:select wire:model="category" label="Categoria" placeholder="seleziona">
                        <flux:select.option value="">-</flux:select.option>
                        @foreach($categories as $cat)
                        <flux:select.option wire:key="{{$cat['id']}}" value="{{$cat['id']}}">
                            {{$cat['label']}}
                        </flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <flux:textarea wire:model="content" rows="15" label="Scrivi qualcosa" />
                <flux:checkbox wire:model="is_important" label="Importante" />
            </div>
            <div class="flex justify-end">
                <flux:button icon="check" variant="filled" wire:click="createNote">
                    Crea
                </flux:button>
            </div>
        </div>

    </div>
</div>