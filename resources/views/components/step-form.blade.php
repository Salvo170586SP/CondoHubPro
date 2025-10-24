@props(['currentStep'])

<div class="px-5 w-full pb-[18px] -mt-5 mb-5 flex items-center justify-center ">

    <div
        class="@if ($currentStep >= 1) text-gray-800 dark:text-white @else text-[#B9B9B9] @endif flex items-center justify-center font-medium">
        <span
            class="flex items-center font-medium justify-center h-[25px] w-[40px] @if ($currentStep >= 1) border border-gray-300 dark:border-zinc-500 text-gray-50 bg-gray-700 dark:bg-zinc-600 @else  bg-gray-50 dark:bg-zinc-500 @endif me-1 rounded">1</span>
        Dati Anagrafici
    </div>

    <span
        class="inline-block @if ($currentStep >= 2) bg-gray-800 dark:bg-zinc-500 @else bg-gray-300 dark:bg-zinc-600 @endif w-[90px] h-[1px] mx-3"></span>

    <div
        class="@if ($currentStep >= 2) text-gray-800 dark:text-white @else text-[#B9B9B9] @endif flex items-center justify-center font-medium">
        <span
            class="flex items-center font-medium justify-center h-[25px] w-[40px] @if ($currentStep >= 2) border border-gray-300 dark:border-zinc-500 text-gray-50 bg-gray-700 dark:bg-zinc-600 @else  bg-gray-50 dark:bg-zinc-500 @endif me-1 rounded">2</span>
        Condomini Associati
    </div>

    <span
        class="inline-block @if ($currentStep == 3) bg-gray-800 dark:bg-zinc-500 @else bg-gray-300 dark:bg-zinc-600 @endif w-[90px] h-[1px] mx-3"></span>
    <div
        class="@if ($currentStep == 3) text-gray-800 dark:text-white @else text-[#B9B9B9] @endif flex items-center justify-center font-medium">
        <span
            class="flex items-center font-medium justify-center h-[25px] w-[40px] @if ($currentStep == 3) border border-gray-300 dark:border-zinc-500 text-gray-50 bg-gray-700 dark:bg-zinc-600 @else  bg-gray-50 dark:bg-zinc-500 @endif me-1 rounded">3</span>
        Recap
    </div>
</div>
