<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\Condominium;
use App\Models\NoticeBoard;
use Livewire\Component;

class DeleteNotices extends Component
{
    public NoticeBoard $notice;
    public  $condominium_id;

    public function mount(NoticeBoard $notice)
    {
        $this->notice = $notice;
        $this->condominium_id = $notice->condominium_id;
    }

    public function deleteNotice()
    {
        try {
            if ($this->notice) {
                $this->notice->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            return $this->redirect("/condominiums/$this->condominium_id/show", navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di eliminazione. Riprova.');
            return $this->redirect("/condominiums/$this->condominium_id/show", navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.notices-board.delete-notices');
    }
}
