<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Auth;
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
    public $is_important = false;

    public function mount(NoticeBoard $notice)
    {
        $this->notice = $notice;
        $this->condominium_id = $notice->condominium_id;
        $this->title = $notice->title;
        $this->description = $notice->description;
        $this->type = $notice->type;

        $this->url_pdf = optional($notice->document)->url_pdf ?? null;
        $this->is_important = (bool) $notice->is_important;
    }


    public function submit()
    {
        $this->validate([
            'title' => 'required|max:50|string',
            'description' => 'required|string',
            'type' => 'required',
            'is_important' => 'boolean',
        ], [
            'title.required' => 'il campo è obbligatorio',
            'title.max' => 'max 50 caratteri',
            'description.required' => 'il campo è obbligatorio',
            'type.required' => 'il campo è obbligatorio',
        ]);

        try {
            $currentUrl = $this->notice->document->url_pdf ?? null;
            $nameFile = $this->notice->document->name_file ?? null;
            $mimeType = $this->notice->document->mime_type ?? null;

            if ($this->url_pdf && !is_string($this->url_pdf)) {
                $newUrl = $this->url_pdf->store('pdfsNotice', 'public');
                $newNameFile = $this->url_pdf->getClientOriginalName();
                $newMimeType = $this->url_pdf->getMimeType();
                if ($currentUrl && Storage::disk('public')->exists($currentUrl)) {
                    Storage::disk('public')->delete($currentUrl);
                }

                $url = $newUrl;
                $nameFile = $newNameFile;
                $mimeType = $newMimeType;
            } else {
                $url = $currentUrl;
            }

            $this->notice->update([
                'condominium_id' => $this->condominium_id,
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->type,
                'url_pdf' => $url,
                'is_important' => $this->is_important,
            ]);

            $document = $this->notice->document;

            if ($document) {
                $document->update([
                    'notice_board_id' => $this->notice->id,
                    'condominium_id' => $this->condominium_id,
                    'uploaded_by' => Auth::id(),
                    'name_file' => $nameFile,
                    'url_pdf' => $url,
                    'mime_type' => $mimeType,
                ]);
            } else {
                $this->notice->document()->create([
                    'notice_board_id' => $this->notice->id,
                    'condominium_id' => $this->condominium_id,
                    'uploaded_by' => Auth::id(),
                    'name_file' => $nameFile,
                    'url_pdf' => $url,
                    'mime_type' => $mimeType,
                ]);
            }

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
