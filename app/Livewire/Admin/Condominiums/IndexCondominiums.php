<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\City;
use App\Models\Condominium;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCondominiums extends Component
{
    use WithPagination;
    public $search = '';
    public $search_city = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSearchCity()
    {
        $this->resetPage();
    }

    public function render()
    {
        $condominiums = Condominium::query();

        if ($this->search) {
            $condominiums = $condominiums->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->search_city) {
            $condominiums = $condominiums->where('city_id', $this->search_city);
        }

        $condominiums = $condominiums->latest()->paginate();

        $cities = City::all();

        return view('livewire.admin.condominiums.index-condominiums', compact('condominiums', 'cities'));
    }
}
