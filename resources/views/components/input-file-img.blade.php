@props([
'text' => '',
'model' => '',
'existingImage' => null
])

<div x-data="{ 
    previewUrl: @js($existingImage),
    fileName: '',
    onFileSelect(event) {
        const file = event.target.files[0];
        if (file) {
            this.fileName = file.name;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewUrl = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
}" class="flex flex-col items-center justify-center gap-2">

    <!-- Placeholder o Preview Immagine -->
    <figure class="w-50 h-50 rounded-lg overflow-hidden border border-zinc-400">
        <template x-if="previewUrl">
            <img class="w-full h-full object-cover" :src="previewUrl" alt="Anteprima">
        </template>
        <template x-if="!previewUrl">
            <div class="w-full h-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="size-12 text-zinc-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5zm10.5-11.25h.008v.008h-.008v-.008zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0z" />
                </svg>
            </div>
        </template>
    </figure>


    <!-- Upload Button -->
    <label for="{{$model}}"
        class="flex items-center justify-center gap-2 border border-zinc-400 dark:border-zinc-600 w-[150px] p-2 rounded-lg bg-zinc-200 hover:bg-zinc-300 dark:bg-zinc-600 dark:hover:bg-zinc-700 cursor-pointer font-medium text-sm">
        {{$text}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
        </svg>
        <input type="file" class="hidden" id="{{$model}}" wire:model="{{$model}}"
            @change="onFileSelect($event)" accept="image/*" />
    </label>

    <!-- Nome del file selezionato -->
    <p x-show="fileName" x-text="fileName" class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
    </p>

</div>