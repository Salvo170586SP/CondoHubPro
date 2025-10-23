<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditNotices extends Component
{
    use WithFileUploads;

    public NoticeBoard $notice;
    public $condominium_id;
    public $title = '';
    public $description = '';
    public $type = '';
    public $url_pdf = null;

    public function mount(NoticeBoard $notice)
    {
        $this->notice = $notice;
        $this->condominium_id = $notice->condominium_id;
        $this->title = $notice->title;
        $this->description = $notice->description;
        $this->type = $notice->type;
        $this->url_pdf = $notice->url_pdf;
    }


    public function submit()
    {
        $this->validate([
            'title' => 'required|max:50|string',
            'description' => 'required|string',
            'type' => 'required',
            'condominium_id' => 'required',
        ], [
            'title.required' => 'il campo è obbligatorio',
            'title.max' => 'max 50 caratteri',
            'description.required' => 'il campo è obbligatorio',
            'type.required' => 'il campo è obbligatorio',
            'condominium_id.required' => 'il campo è obbligatorio',
        ]);

        try {
            $url = $this->notice->url_pdf;

            if ($this->url_pdf && !is_string($this->url_pdf)) {
                if ($this->notice->url_pdf) {
                    Storage::disk('public')->delete($this->notice->url_pdf);
                }
                $url = $this->url_pdf->store('pdfsNotice', 'public');
            }

            $this->notice->update([
                'condominium_id' => $this->condominium_id,
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->type,
                'url_pdf' => $url,
            ]);

            session()->flash('messageNotice', 'Elemento modificato con successo!');
            return $this->redirect("/admin/condominiums/$this->condominium_id/show", navigate: true);
        } catch (\Throwable $th) {
            session()->flash('errorNotice', 'Errore di creazione. Riprova.');
            return $this->redirect("/admin/condominiums/$this->condominium_id/show", navigate: true);
        }
    }
    public function render()
    {
        $types = config('Condo.types');
        return view('livewire.admin.notices-board.edit-notices', compact('types'));
    }
}
