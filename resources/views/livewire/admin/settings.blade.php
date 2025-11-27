<div>
    <div class="container mx-auto relative h-full space-y-3">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Impostazioni
        </flux:breadcrumbs>
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Impostazini</h2>
        </div>

        <div class="w-full grid grid-cols-2 gap-3">
            <div class="w-full border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 p-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <h2 class="font-medium text-xl mb-4">Dati Personali</h2>
                    @if(!$is_edit)
                    <flux:button icon="pencil" wire:click="toggleEdit" variant="filled">Modifica</flux:button>
                    @else
                    <div>
                        <flux:button icon="arrow-left" wire:click="toggleEdit" variant="filled">Annulla</flux:button>
                        <flux:button icon="check" variant="filled" wire:click="submit">Salva</flux:button>
                    </div>
                    @endif
                </div>
                @if(!$is_edit)
                <div class="flex gap-3">
                    <figure
                        class="w-38 h-38 bg-zinc-300 border border-zinc-200 dark:border-zinc-500 dark:bg-zinc-600 rounded-lg overflow-hidden">
                        @if(auth()->user()->img_user)
                        <img src="{{ asset('storage/' . auth()->user()->img_user)}}" class="w-full h-full object-cover object-center"
                            alt="{{auth()->user()->img_user}}">
                        @else
                        <div class="w-full h-full font-bold text-5xl uppercase flex items-center justify-center">{{
                            auth()->user()->initials() }}</div>
                        @endif
                    </figure>
                    <div>
                        <div>
                            <span class="text-sm">Nome:</span>
                            <div class="capitalize font-bold text-lg">{{auth()->user()->getFullName()}}</div>
                        </div>
                        <div>
                            <span class="text-sm">Email:</span>
                            <div class="font-bold text-sm">{{auth()->user()->email}}</div>
                        </div>
                        <div>
                            <span class="text-sm">Telefono:</span>
                            <div class="font-bold text-sm">{{auth()->user()->phone_number ?? '-'}}</div>
                        </div>
                    </div>
                </div>
                @else

                <div class="w-full mt-5">
                    <div class="w-full flex flex-col mb-5 gap-2">
                        <x-input-file model="img_user" text="Allega foto" />
                        <figure
                            class="w-38 h-38 bg-zinc-300 border border-zinc-200 dark:border-zinc-500 dark:bg-zinc-600 rounded-lg  overflow-hidden">
                            @if($img_user && is_object($img_user))
                            {{-- Anteprima immagine temporanea --}}
                            <img src="{{ $img_user->temporaryUrl() }}" class="w-full h-full object-cover object-center"
                                alt="Anteprima">
                            @elseif(auth()->user()->img_user)
                            {{-- Immagine esistente --}}
                            <img src="{{ asset('storage/' . auth()->user()->img_user)}}"
                                class="w-full h-full object-cover object-center" alt="{{auth()->user()->img_user}}">
                            @else
                            {{-- Iniziali --}}
                            <div class="w-full h-full font-bold text-5xl uppercase flex items-center justify-center">
                                {{ auth()->user()->initials() }}
                            </div>
                            @endif
                        </figure>
                    </div>
                    <div class="space-y-3 font-medium text-sm">
                        <div class="grid grid-cols-2 gap-3">
                            <flux:input label="Nome" wire:model="name" />
                            <flux:input label="Cognome" wire:model="surname" />
                        </div>
                        <div class="grid grid-cols-2 items-center gap-3">
                            <flux:input label="Telefono" wire:model="phone_number" />
                            <flux:checkbox label="Cambia Password" wire:model.live="change_password" />
                        </div>
                        @if($change_password)
                        <div class="h-25">
                            <flux:input type="password" label="Password" wire:model="password" viewable />
                            <span class="text-xs">*La password recedente verrà sovrascritta</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <div class="border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 p-3 rounded-lg">
                <h2 class="font-medium text-xl mb-4">Settaggi</h2>
                <div class="space-y-2" x-cloak>
                    <flux:field variant="inline">
                        <flux:label>Notifiche Pagamenti</flux:label>
                        <flux:switch wire:model.live="is_active" />
                        <flux:error name="is_active" />
                    </flux:field>
                    <flux:field variant="inline">
                        <flux:label>Ricezione Mail Pagamenti</flux:label>
                        <flux:switch wire:model.live="is_active_mail" />
                        <flux:error name="is_active_mail" />
                    </flux:field>
                </div>
            </div>
        </div>
    </div>
</div>