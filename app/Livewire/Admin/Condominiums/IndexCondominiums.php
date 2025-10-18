<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Condominium;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCondominiums extends Component
{
    use WithPagination;
    
    public function render()
    {
        $condominiums = Condominium::latest()->paginate();
        return view('livewire.admin.condominiums.index-condominiums', compact('condominiums'));
    }
}
