<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Condominium;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ShowDocuments extends Component
{
    use WithPagination;
    public Condominium $condominium;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function deleteDocument($doc_id)
    {
        try {
            $document = Document::findOrFail($doc_id);

            if ($document) {

                if (!empty($document->url_pdf)) {
                    if (Storage::disk('public')->exists($document->url_pdf)) {
                        Storage::disk('public')->delete($document->url_pdf);
                    }
                }

                $document->delete();
            }

            $condominium_id = $this->condominium->id;
            session()->flash('message', 'Elemento eliminato con successo!');
            return $this->redirect("/admin/archive/$condominium_id/show", navigate: true);
        } catch (\Throwable $th) {
            $condominium_id = $this->condominium->id;
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            return $this->redirect("/admin/archive/$condominium_id/show", navigate: true);
        }
    }

    public function render()
    {
        $docs = $this->condominium->documents();
 
        if (!empty($this->search)) {
            $docs =  $docs->where('name_file', 'like', '%' . $this->search . '%');
        }

        $docs = $docs->paginate(10);

        return view('livewire.admin.documents.show-documents', compact('docs'));
    }
}
