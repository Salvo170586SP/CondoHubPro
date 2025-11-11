<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Mia Agenda</flux:breadcrumbs.item>
        </flux:breadcrumbs>


        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Mia Agenda</h2>
            <flux:button icon="plus" variant="filled" wire:navigate href="/admin/diary/create">
                Scrivi Nota
            </flux:button>
        </div>

        <div class="w-full h-[30px]">
            @if (session('message'))
            <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
            <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full h-[70px] flex items-center justify-between">
            <div class=" flex items-center gap-3">
                <div class="w-100">
                    <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
                </div>
                <div class="flex items-center space-x-3">
                    <flux:select wire:model.live="filterCategory" id="priority" placeholder="Filtra per categoroia">
                        <flux:select.option value="">Mostra Tutti</flux:select.option>
                        @foreach ($categories as $cat)
                        <flux:select.option value="{{ $cat['id'] }}" wire:key="{{ $cat['id'] }}">
                            {{ $cat['label'] }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div class="w-50">
                    <flux:input wire:model.live="dateSearch" type="date" max="2999-12-31" />
                </div>
                <flux:checkbox wire:model.live="filterImportant" label="Filtra per importanza" />
            </div>
            <flux:button wire:click="resetFilter" variant="filled">Reset filtri</flux:button>
        </div>

        <div class="mb-5">
            {{ $diaries->links('vendor.livewire.tailwind') }}
        </div>
        @forelse ($diaries as $d)
        <x-card-diary :d="$d" :categories="$categories" />
        @empty
        <div
            class="w-full text-center font-medium text-sm text-zinc-500 dark:text-white dark:bg-zinc-500/40 bg-zinc-200/40 p-3 border dark:border-zinc-600 rounded-lg">
            Non ci sono note in agenda
        </div>
        @endforelse
    </div>
</div>