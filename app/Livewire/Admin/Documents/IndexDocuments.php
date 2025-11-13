<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Condominium;
use Illuminate\Support\Facades\Auth;
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

    if (auth()->user()->hasRole('amministratore')) {
      $condominiums = $condominiums->where('administrator_id', Auth::id())->latest()->paginate(10);
    }

    if ($this->search) {
      $condominiums = $condominiums->where('name', 'like', '%' . $this->search . '%');
    }

    $condominiums = $condominiums->latest()->paginate(10);

    return view('livewire.admin.documents.index-documents', compact('condominiums'));
  }
}
