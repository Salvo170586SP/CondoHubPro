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
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $apartments = Apartment::query();

        if ($this->search) {
            $apartments = $apartments->where('name', 'like', '%' . $this->search . '%');
        }

        $apartments = $apartments->where('condominium_id', $this->condominium->id)->latest()->paginate(10);

        return view('livewire.admin.condominiums.table-apartments', compact('apartments'));
    }
}
