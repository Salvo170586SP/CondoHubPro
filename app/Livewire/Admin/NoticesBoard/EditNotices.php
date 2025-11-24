<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\Document;
use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    public $is_important = false;

    public $url_pdf;
    public $new_file;

    public function mount(NoticeBoard $notice)
    {
        $this->notice = $notice;
        $this->condominium_id = $notice->condominium_id;
        $this->title = $notice->title;
        $this->description = $notice->description;
        $this->type = $notice->type;
        $this->is_important = (bool) $notice->is_important;
        $this->url_pdf = optional($notice->document)->url_pdf ?? null;
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required|max:50|string',
            'description' => 'required|string',
            'type' => 'required',
            'is_important' => 'boolean',
            'new_file' => 'nullable|file',
        ]);

        try {
            $this->notice->update([
                'condominium_id' => $this->condominium_id,
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->type,
                'is_important' => $this->is_important,
            ]);

            $document = $this->notice->document;

            if ($this->new_file) {

                $nameFile = $this->new_file->getClientOriginalName();
                $mimeType = $this->new_file->getMimeType();
                $url = $this->new_file->store('pdfsNotice', 'public');

                if ($document) {
                    if (Storage::disk('public')->exists($document->url_pdf)) {
                        Storage::disk('public')->delete($document->url_pdf);
                    }

                    $document->update([
                        'name_file' => $nameFile,
                        'url_pdf' => $url,
                        'mime_type' => $mimeType,
                    ]);
                } else {
                    Document::create([
                        'uploaded_by' => Auth::id(),
                        'condominium_id' => $this->condominium_id,
                        'notice_board_id' => $this->notice->id,
                        'name_file' => $nameFile,
                        'url_pdf' => $url,
                        'mime_type' => $mimeType,
                    ]);
                }
            }

            session()->flash('message', 'Elemento modificato con successo!');
        } catch (\Throwable $th) {
            Log::error('Errore edit: ' . $th->getMessage());
            session()->flash('error', 'Errore generico.');
        }

        return $this->redirect("/admin/notices-board/$this->condominium_id", navigate: true);
    }
    public function render()
    {
        $types = config('Condo.types');
        return view('livewire.admin.notices-board.edit-notices', compact('types'));
    }
}
