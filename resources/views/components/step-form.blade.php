@props([
'steps' => [],
'currentStep' => 1
])

<div class="px-5 w-full pb-[18px] -mt-5 mb-5 flex items-center justify-center">
    @foreach($steps as $index => $stepName)
    @php
    $stepNumber = $index + 1;
    $isActive = $currentStep >= $stepNumber;
    $isNotLast = !$loop->last;
    @endphp

    {{-- Step --}}
    <div
        class="@if($isActive) text-gray-800 dark:text-white @else text-[#B9B9B9] @endif flex items-center justify-center font-medium">
        <span
            class="flex items-center font-medium justify-center h-[25px] w-[40px] @if($isActive) border border-gray-300 dark:border-zinc-500 text-gray-50 bg-gray-700 dark:bg-zinc-600 @else bg-gray-50 dark:bg-zinc-500 @endif me-1 rounded">
            {{ $stepNumber }}
        </span>
        {{ $stepName }}
    </div>

    {{-- Connector line --}}
    @if($isNotLast)
    <span
        class="inline-block @if($currentStep > $stepNumber) bg-gray-800 dark:bg-zinc-500 @else bg-gray-300 dark:bg-zinc-600 @endif w-[90px] h-[1px] mx-3"></span>
    @endif
    @endforeach
</div>