@props([
'text' => '',
'model' => ''
])

<div x-data="{ fileName: '' }" class="flex gap-3">
    <label for="{{$model}}"
        class="flex items-center justify-center gap-2 border border-zinc-400 dark:border-zinc-600 w-[150px] p-2 rounded-lg bg-zinc-200 hover:bg-zinc-300 dark:bg-zinc-600 dark:hover:bg-zinc-700 cursor-pointer font-medium text-sm">
        {{$text}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
        </svg>
        <input type="file" class="hidden" id="{{$model}}" wire:model="{{$model}}"
            @change="fileName = $event.target.files[0]?.name || ''" />
    </label>
</div>