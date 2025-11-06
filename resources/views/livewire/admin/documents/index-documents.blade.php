<div>
    <div class="container mx-auto relative h-full flex-1 p-2">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Archivio</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="w-full h-[30px]">
            @if (session('message'))
            <flux:badge color="zinc" class="w-full">{{ session('message') }}</flux:badge>
            @elseif(session('error'))
            <flux:badge color="red" class="w-full">{{ session('error') }}</flux:badge>
            @endif
        </div>

        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-xl font-medium">Archivi</h2>
        </div>
        <div class="flex space-x-3 my-3">
            <div class="w-100">
                <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Cerca..." />
            </div>
        </div>


        {{$condominiums->links('vendor.livewire.tailwind')}}
        <div class="w-full my-5 grid grid-cols-5 gap-2">
            @foreach ($condominiums as $condominium)
            <div wire:key="archiveCodn-{{ $condominium->id }}-{{ str()->random(10) }}" class="max-w-[300px] h-[200px]">
                <button wire:navigate href="/admin/archive/{{ $condominium->id }}/show"
                    class="w-full h-full rounded-lg border bg-zinc-50 hover:bg-zinc-100 dark:bg-zinc-600/30 dark:hover:bg-zinc-600/60 dark:border-zinc-600 cursor-pointer">
                    <div class="w-full h-[150px] flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-30 text-zinc-600 dark:text-zinc-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                        </svg>
                    </div>
                    <div
                        class="w-full h-[50px] border-t border-white dark:border-zinc-600 flex justify-center items-center">
                        {{ $condominium->name }}
                    </div>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>