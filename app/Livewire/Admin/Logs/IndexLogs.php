<?php

namespace App\Livewire\Admin\Logs;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class IndexLogs extends Component
{
    public $logs = [];
    public $autoRefresh = true;
    public $filterLevel = 'all';
    public $searchTerm = '';
    public $maxLines = 500;

    public function loadLogs()
    {
        $logFile = storage_path('logs/laravel.log');

        if (!File::exists($logFile)) {
            $this->logs = [];
            return;
        }

        // Leggi il file di log
        $content = File::get($logFile);
        $lines = explode("\n", $content);

        // Prendi solo le ultime N righe per performance
        $lines = array_slice($lines, -$this->maxLines);

        $this->logs = $this->parseLogLines($lines);

        if ($this->filterLevel !== 'all') {
            $this->logs = array_filter($this->logs, function ($log) {
                return strtolower($log['level']) === $this->filterLevel;
            });
        }

        if ($this->searchTerm) {
            $this->logs = array_filter($this->logs, function ($log) {
                return stripos($log['message'], $this->searchTerm) !== false;
            });
        }

        $this->logs = array_reverse(array_values($this->logs));
    }

    private function parseLogLines($lines)
    {
        $logs = [];
        $currentLog = null;

        foreach ($lines as $line) {
            // Pattern per identificare l'inizio di un nuovo log
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] \w+\.(\w+): (.*)$/', $line, $matches)) {
                // Salva il log precedente se esiste
                if ($currentLog !== null) {
                    $logs[] = $currentLog;
                }

                // Inizia un nuovo log
                $currentLog = [
                    'timestamp' => $matches[1],
                    'level' => strtoupper($matches[2]),
                    'message' => $matches[3],
                    'stacktrace' => []
                ];
            } elseif ($currentLog !== null && trim($line) !== '') {
                // Aggiungi la riga allo stacktrace del log corrente
                $currentLog['stacktrace'][] = $line;
            }
        }

        // Aggiungi l'ultimo log
        if ($currentLog !== null) {
            $logs[] = $currentLog;
        }

        return $logs;
    }

    public function clearLogs()
    {
        try {
            // Solo admin può svuotare i log
            if (!auth()->user()->hasRole('admin')) {
                session()->flash('error', 'Non hai i permessi per questa operazione');
                return;
            }

            $logFile = storage_path('logs/laravel.log');

            if (File::exists($logFile)) {
                File::put($logFile, '');
            }

            $this->loadLogs();
            session()->flash('message', 'Logs svuotati con successo');
            Log::info('Eliminazione Logs - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Logs - Errore di eliminazione');
        }

        return $this->redirect('/admin/logs', navigate: true);
    }

    public function render()
    {
        $this->loadLogs();
        return view('livewire.admin.logs.index-logs');
    }
}
