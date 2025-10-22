<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCities extends Component
{
    use WithPagination;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $cities = City::query();

        if ($this->search) {
            $cities = $cities->where('name_city', 'like', '%' . $this->search . '%');
        }

        $cities = $cities->latest()->paginate(10);

        return view('livewire.admin.cities.index-cities', compact('cities'));
    }
}
