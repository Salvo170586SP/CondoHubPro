<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <div
            class="h-[55px] border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 flex justify-end items-center rounded-lg px-10">
            <livewire:admin.notifications />
        </div>
        <div class="mt-10">
            {{ $slot }}
            <x-messages />
        </div>
    </flux:main>
</x-layouts.app.sidebar>