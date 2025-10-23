<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class TableCityCondominiums extends Component
{
    use WithPagination;
    public City $city;


    public function mount(City $city)
    {
        $this->city = $city;
    }

    public function render()
    {
        $cityCondominiums = $this->city->condominiums()->paginate(10);
        return view('livewire.admin.cities.table-city-condominiums', compact('cityCondominiums'));
    }
}
