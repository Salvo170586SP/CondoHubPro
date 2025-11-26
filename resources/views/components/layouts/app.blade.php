<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>

        {{-- Header --}}
        <div class="flex gap-3 -m-3">
            <div
                class="flex-1 h-[55px] z-50  border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 flex items-center rounded-lg px-10">
                <div class="font-bold uppercase">
                    {{auth()->user()->getFullName()}}
                </div>
            </div>
            <div
                class="w-[200px]  h-[55px]  z-50 border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 flex justify-end items-center rounded-lg px-10">
                <flux:button icon="adjustments-vertical" variant="ghost" wire:navigate href="/admin/settings"
                    title="Impostazioni" />
                <livewire:admin.notifications />
            </div>
        </div>

        {{-- Content --}}
        <div class="mt-10">
            {{ $slot }}
            <x-messages />
        </div>
    </flux:main>
</x-layouts.app.sidebar>