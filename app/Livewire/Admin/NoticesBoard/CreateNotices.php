<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\Condominium;
use App\Models\Document;
use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            'url_pdf' => 'nullable|file|max:5120',
            'is_important' => 'boolean',
        ], [
            'title.required' => 'il campo è obbligatorio',
            'title.max' => 'max 50 caratteri',
            'description.required' => 'il campo è obbligatorio',
            'type.required' => 'il campo è obbligatorio',
        ]);

        try {
            $condominium = Condominium::findOrFail($this->condominium_id);

            $notice = NoticeBoard::create([
                'condominium_id' => $this->condominium_id,
                'created_by' =>   Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->type,
                'is_important' => $this->is_important,
            ]);

            $url = null;
            $nameFile = null;
            $mimeType = null;

            if ($this->url_pdf) {
                $nameFile = $this->url_pdf->getClientOriginalName();
                $mimeType = $this->url_pdf->getMimeType();
                $url = $this->url_pdf->store('pdfsNotice', 'public');

                Document::create([
                    'notice_board_id' => $notice->id,
                    'condominium_id' => $condominium->id,
                    'uploaded_by' => Auth::id(),
                    'name_file' => $nameFile,
                    'url_pdf' => $url,
                    'mime_type' => $mimeType,
                ]);
            }

            session()->flash('message', 'Elemento creato con successo!');
            Log::info('Creazione Nota Bacheca - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            Log::error('Creazione Nota Bacheca - Errore di creazione');
        }

        return $this->redirect("/admin/notices-board/$condominium->id", navigate: true);
    }

    public function render()
    {
        $types = config('Condo.types');
        return view('livewire.admin.notices-board.create-notices', compact('types'));
    }
}
