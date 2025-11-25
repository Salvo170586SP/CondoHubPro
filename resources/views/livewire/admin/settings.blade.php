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

            <div class="border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 p-3 rounded-lg">
                <h2 class="font-medium text-xl mb-4">Dati Personali</h2>
                <div class="flex gap-3">
                    <figure class="w-50 h-50 bg-zinc-300 border border-zinc-200 dark:border-zinc-500 dark:bg-zinc-600 rounded-lg  overflow-hidden">
                        @if(auth()->user()->img_user)
                        <img src="{{ asset('storage/' . auth()->user()->img_user)}}" class="w-full h-full object-center"
                            alt="{{auth()->user()->img_user}}">
                        @else
                        <div class="w-full h-full font-bold text-5xl uppercase flex items-center justify-center">{{
                            auth()->user()->initials() }}</div>
                        @endif
                    </figure>
                    <div class="space-y-1 font-medium text-sm">
                        <div >Nome: {{auth()->user()->getFullName()}}</div>
                        <div>Email: {{auth()->user()->email}}</div>
                        <div>Telefono: {{auth()->user()->phone_number ?? '-'}}</div>
                    </div>
                </div>
            </div>

            <div class="border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 p-3 rounded-lg">
                <h2 class="font-medium text-xl mb-4">Settaggi</h2>
                <flux:field variant="inline">
                    <flux:label>Abilita Notifiche</flux:label>
                    <flux:switch wire:model.live="is_active" />
                    <flux:error name="is_active" />
                </flux:field>
            </div>

        </div>


    </div>
</div>