<div>
    <div class="container mx-auto relative h-full p-2 space-y-3">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
        </flux:breadcrumbs>
        <div class="w-full flex justify-between items-center my-5">
            <h2 class="w-full text-2xl font-medium">Dashboard</h2>
        </div>
        <div class="h-[280px] border dark:border-zinc-600 shadow rounded-lg p-5 bg-gradient-to-br from-indigo-400/40 dark:from-indigo-600/40 to-transparent">
            <p class="text-sm font-bold text-zinc-600 dark:text-white capitalize mb-3"> {{ auth()->user()->getRoleNames()->first() }}</p>
            <h2 class="text-xl font-bold">Benvenuto, {{ auth()->user()->getFullName() }}!</h2>
            <div class="w-full flex gap-2">
                <div class="my-3 shadow border border-zinc-500 w-[220px] text-slate-600 dark:text-white rounded-lg bg-slate-50 dark:bg-zinc-700 p-2">
                    <div class="font-medium flex justify-between items-center">
                        Totale Amministratori: <span
                            class="inline-flex ms-2 h-5 w-5 bg-black text-white rounded-full justify-center items-center text-sm">{{ $administrators->count() }}</span>
                    </div>
                </div>
                <div class="my-3 shadow border border-zinc-500 w-[220px] text-slate-600 rounded-lg dark:text-white bg-slate-50 dark:bg-zinc-700 p-2">
                    <div class="w-full font-medium flex justify-between items-center">
                        Totale Residenti: <span
                            class="inline-flex ms-2 h-5 w-5 bg-black  text-white rounded-full justify-center items-center text-sm">{{ $residents->count() }}</span>
                    </div>
                </div>
                <div class="my-3 shadow border border-zinc-500 w-[220px] text-slate-600 rounded-lg dark:text-white bg-slate-50 dark:bg-zinc-700  p-2">
                    <div class="font-medium flex justify-between items-center">
                        Totale Avvisi Bacheca: <span
                            class="inline-flex ms-2 h-5 w-5 bg-black text-white rounded-full justify-center items-center text-sm">{{ $noticeBoards->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="h-[300px] py-3 text-zinc-700 dark:text-white">
                @if (auth()->user()->getRoleNames()->first() == 'admin')
                    Ciao Admin, qui puoi avere il pieno controllo di tutto il CRM.
                    <br>
                    Puoi creare, modificare, eliminare qualiasi contenuto.
                @elseif(auth()->user()->getRoleNames()->first() == 'admin')
                    Ciao Admin.
                    <br>
                    Puoi creare, modificare, eliminare qualiasi contenuto relativi ai tuoi condomini e ai relativi
                    residenti.
                @elseif(auth()->user()->getRoleNames()->first() == 'residente')
                    Ciao Residente.
                    <br>
                    Puoi consultare i tuoi avvisi in bacheca relativi ai tuoi condomini di resideza.
                @endif
            </div>
        </div>
        <div class="w-full grid md:grid-cols-2 grid-cols-1 md:space-x-3">
            <x-card-dashboard :items="$administrators" :urlAll="'/admin/administrators'" :urlItem="'/admin/administrators/{id}/show'">
                <div>
                    <h3 class="font-medium text-lg">Ultimi Amministratori Registrati</h3>
                    <p class="text-zinc-400 text-sm">Elenco degli ultimi 3 amministratori registrati</p>
                </div>
            </x-card-dashboard>
            <x-card-dashboard :items="$residents" :urlAll="'/admin/residents'" :urlItem="'/admin/residents/{id}/show'">
                <div>
                    <h3 class="font-medium text-lg">Ultimi Residenti Registrati</h3>
                    <p class="text-zinc-400 text-sm">Elenco degli ultimi 3 residenti registrati</p>
                </div>
            </x-card-dashboard>
        </div>

        <x-card-dashboard-notice :items="$noticeBoards" :types="$types">
            <div>
                <h3 class="font-medium text-lg">Ultimi Avvisi Importanti</h3>
                <p class="text-zinc-400 text-sm">Elenco degli ultimi 3 avvisi</p>
            </div>
        </x-card-dashboard-notice>
    </div>
</div>
