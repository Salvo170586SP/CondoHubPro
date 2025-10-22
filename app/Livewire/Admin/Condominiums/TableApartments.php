<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Apartment;
use App\Models\Condominium;
use Livewire\Component;
use Livewire\WithPagination;

class TableApartments extends Component
{
    use WithPagination;

    public Condominium $condominium;

    public function render()
    {
        $apartments = Apartment::where('condominium_id', $this->condominium->id)->latest()->paginate(10);
        return view('livewire.admin.condominiums.table-apartments', compact('apartments'));
    }
}
