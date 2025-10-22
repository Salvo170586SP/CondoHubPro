<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\Condominium;
use App\Models\NoticeBoard;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateNotices extends Component
{
    use WithFileUploads;

    public $condominium_id;
    public $title = '';
    public $description = '';
    public $type = '';
    public $url_pdf = null;
    public $is_important = false;

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
            $condominium = Condominium::findOrFail($this->condominium_id);
            $url = $this->url_pdf;

            if ($this->url_pdf) {
                $url = $this->url_pdf->store('pdfsNotice', 'public');
            }

            NoticeBoard::create([
                'condominium_id' => $this->condominium_id,
                'created_by' =>   $condominium->administrator_id,
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->type,
                'url_pdf' => $url,
                'is_important' => $this->is_important,
            ]);

            session()->flash('messageNotice', 'Elemento creato con successo!');
            return $this->redirect("/condominiums/$this->condominium_id/show", navigate: true);
        } catch (\Throwable $th) {
            session()->flash('errorNotice', 'Errore di creazione. Riprova.');
            return $this->redirect("/condominiums/$this->condominium_id/show", navigate: true);
        }
    }

    public function render()
    {
        $types = config('Condo.types');
        return view('livewire.admin.notices-board.create-notices', compact('types'));
    }
}
