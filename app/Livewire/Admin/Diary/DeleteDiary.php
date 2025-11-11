<?php

namespace App\Livewire\Admin\Diary;

use App\Models\Diary;
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
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
        }

        return $this->redirect('/admin/diary', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.diary.delete-diary');
    }
}
