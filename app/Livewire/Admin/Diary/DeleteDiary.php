<?php

namespace App\Livewire\Admin\Diary;

use App\Models\Diary;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeleteDiary extends Component
{
    public Diary $d;

    public function mount(Diary $d)
    {
        $this->d = $d;
    }

    public function deleteDiary()
    {
        try {
            if ($this->d) {
                $this->d->delete();
            }
            session()->flash('message', 'Elemento eliminato con successo!');
            Log::info('Eliminazione Agenda - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Agenda - Errore di eliminazione');
        }

        return $this->redirect('/admin/diary', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.diary.delete-diary');
    }
}
