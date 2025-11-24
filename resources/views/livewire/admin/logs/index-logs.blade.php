<div x-data="{ 
    showStacktrace: {}, 
 }">
    <div class="container mx-auto relative h-full">
        <flux:breadcrumbs class="-mt-5 mb-5">
            <flux:breadcrumbs.item wire:navigate href="/admin/dashboard" icon="home" />
            <flux:breadcrumbs.item>Logs</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="w-full flex justify-between items-center my-3">
            <h2 class="w-full text-xl font-medium">Logs</h2>

            <div class="flex gap-2 items-center">
                <div class="w-50">
                    <flux:select wire:model.live="filterLevel" class="w-32">
                        <option value="all">Tutti</option>
                        <option value="error">Error</option>
                        <option value="warning">Warning</option>
                        <option value="info">Info</option>
                        <option value="debug">Debug</option>
                    </flux:select>
                </div>

                @role('admin')
                <flux:modal.trigger name="delete-logs">
                    <flux:button icon="trash" variant="primary" color="red">
                        Svuota
                    </flux:button>
                </flux:modal.trigger>
                <flux:modal name="delete-logs" class="md:w-96">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Attenzione!
                            </flux:heading>
                            <flux:text size="md">Sei sicuro di svuotare i logs?
                            </flux:text>
                        </div>
                        <div class="flex">
                            <flux:spacer />
                            <div class="space-x-3">
                                <flux:modal.close>
                                    <flux:button variant="ghost">Cancel</flux:button>
                                </flux:modal.close>
                                <flux:button type="submit" variant="danger" wire:click="clearLogs">Svuota
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </flux:modal>
                @endrole
            </div>
        </div>

        <div class="mb-4">
            <flux:input wire:model.live="searchTerm" placeholder="Cerca..." icon="magnifying-glass" class="w-full" />
        </div>

        <div class="mb-2 text-sm text-gray-600 dark:text-gray-400">
            <strong>{{ count($logs) }}</strong> log
        </div>

        <div class="overflow-hidden">
            <div id="log-container"
                class="w-full h-[600px] rounded-xl bg-slate-900 overflow-y-auto p-4 font-mono text-sm">
                @forelse($logs as $index => $log)
                <div class="mb-3 pb-3 border-b border-slate-700 last:border-0" wire:key="log-{{ $index }}">

                    <div class="flex items-start gap-3">
                        <span class="
                                px-2 py-1 rounded text-xs font-bold uppercase shrink-0
                                {{ $log['level'] === 'ERROR' ? 'bg-red-600 text-white' : '' }}
                                {{ $log['level'] === 'WARNING' ? 'bg-yellow-600 text-white' : '' }}
                                {{ $log['level'] === 'INFO' ? 'bg-blue-600 text-white' : '' }}
                                {{ $log['level'] === 'DEBUG' ? 'bg-gray-600 text-white' : '' }}
                                {{ !in_array($log['level'], ['ERROR', 'WARNING', 'INFO', 'DEBUG']) ? 'bg-purple-600 text-white' : '' }}
                            ">
                            {{ $log['level'] }}
                        </span>

                        <span class="text-slate-400 text-xs shrink-0 mt-1">
                            {{ $log['timestamp'] }}
                        </span>

                        <div class="flex-1 min-w-0">
                            <p class="break-words {{ $log['level'] === 'ERROR' ? 'text-red-400' : 'text-slate-300' }}">
                                {{ $log['message'] }}
                            </p>
                            @if(!empty($log['stacktrace']))
                            <div class="mt-2">
                                <button @click="showStacktrace['{{ $index }}'] = !showStacktrace['{{ $index }}']"
                                    class="text-xs text-blue-400 hover:text-blue-300 underline">
                                    <span x-show="!showStacktrace['{{ $index }}']">Mostra stacktrace</span>
                                    <span x-show="showStacktrace['{{ $index }}']">Nascondi stacktrace</span>
                                </button>

                                <div x-show="showStacktrace['{{ $index }}']" x-collapse
                                    class="mt-2 p-3 bg-slate-900 rounded text-xs text-slate-400 overflow-x-auto">
                                    @foreach($log['stacktrace'] as $line)
                                    <div class="whitespace-pre-wrap break-all">{{ $line }}</div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="flex items-center justify-center h-full text-slate-400">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-slate-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-lg">Nessun log disponibile</p>
                        <p class="text-sm mt-2">I log appariranno qui quando l'applicazione genera eventi</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>