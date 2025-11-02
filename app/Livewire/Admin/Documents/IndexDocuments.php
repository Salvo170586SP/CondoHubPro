<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Condominium;
use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class IndexDocuments extends Component
{
  use WithPagination;
  public $search = '';

  public function updatedSearch()
  {
    $this->resetPage();
  }

  public function render()
  {
    $condominiums = Condominium::query();

    if ($this->search) {
      $condominiums = $condominiums->where('name', 'like', '%' . $this->search . '%');
    }

    $condominiums = $condominiums->latest()->paginate(10);

    return view('livewire.admin.documents.index-documents', compact('condominiums'));
  }
}
