<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\Condominium;
use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Storage;
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
                // Elimina il file se esiste
                if ($this->notice->document->url_pdf && Storage::disk('public')->exists($this->notice->document->url_pdf)) {
                    Storage::disk('public')->delete($this->notice->document->url_pdf);
                }

                $this->notice->delete();
            }

            session()->flash('messageNotice', 'Elemento eliminato con successo!');
        } catch (\Throwable $th) {
            session()->flash('errorNotice', 'Errore di eliminazione. Riprova.');
        }

        return $this->redirect("/admin/notices-board/$this->condominium_id", navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.notices-board.delete-notices');
    }
}
