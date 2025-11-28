<div>
    <div class="relative z-50" x-data="{ isOpen: false }" @click.away="isOpen = false">
        <div class="relative">
            <flux:button variant="ghost" wire:click="markAsRead" @click="isOpen = !isOpen" title="Notifiche">
                @if(auth()->user()->is_active)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.143 17.082a24.248 24.248 0 0 0 3.844.148m-3.844-.148a23.856 23.856 0 0 1-5.455-1.31 8.964 8.964 0 0 0 2.3-5.542m3.155 6.852a3 3 0 0 0 5.667 1.97m1.965-2.277L21 21m-4.225-4.225a23.81 23.81 0 0 0 3.536-1.003A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6.53 6.53m10.245 10.245L6.53 6.53M3 3l3.53 3.53" />
                </svg>
                @endif
            </flux:button>
            @if ($unreadCount > 0)
            <span
                class="absolute top-2 right-4 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{
                $unreadCount }}</span>
            @endif
        </div>
        <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-50"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-50" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="py-3 bg-white/80 border backdrop-blur-lg border-zinc-300  dark:border-zinc-600 dark:bg-zinc-700 dark:text-white w-[300px] rounded-lg z-50 shadow-lg absolute top-13 right-0">
            @if (count($notifications) > 0 )
            <div class="flex justify-between items-center mb-5 px-3">
                <span
                    class="inline-flex w-5 h-5 justify-center items-center rounded-full bg-gray-400 dark:bg-white dark:text-black text-center font-bold text-white">{{
                    count($notifications) }}</span>
                <button wire:click="destroyAll"
                    class="text-red-50 bg-red-500 hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800 text-sm flex rounded px-2 py-1 font-medium">
                    Elimina tutte
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 ms-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
            <div class="max-h-[300px] w-full overflow-y-auto px-3">
                @foreach ($notifications as $notification)
                <div wire:key="notification-{{$notification->id}}"
                    class="border-b last:border-b-0 py-2 flex justify-between items-start">
                    <div>
                        <p class="font-bold text-sm"> <span
                                class="text-xs text-zinc-400 dark:text-white font-medium me-2">ID
                                pagamento:</span>{{ $notification->data['payment_id'] }}</p>
                        <p class="text-sm">{{ $notification->data['message'] }}</p>
                    </div>
                    <button wire:click="destroy('{{ $notification->id }}')" title="Elimina notifica"
                        class="text-red-50 bg-red-500 hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800 text-sm flex rounded  px-2 py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center text-gray-500 dark:text-zinc-400 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.143 17.082a24.248 24.248 0 0 0 3.844.148m-3.844-.148a23.856 23.856 0 0 1-5.455-1.31 8.964 8.964 0 0 0 2.3-5.542m3.155 6.852a3 3 0 0 0 5.667 1.97m1.965-2.277L21 21m-4.225-4.225a23.81 23.81 0 0 0 3.536-1.003A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6.53 6.53m10.245 10.245L6.53 6.53M3 3l3.53 3.53" />
                </svg>
                Nessuna notifica
            </div>
            @endif
        </div>
    </div>
</div>