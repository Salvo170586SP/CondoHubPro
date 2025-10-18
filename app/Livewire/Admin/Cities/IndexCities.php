<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCities extends Component
{
    use WithPagination;
    
    public function render()
    {
        $cities = City::latest()->paginate(10);
        return view('livewire.admin.cities.index-cities', compact('cities'));
    }
}
