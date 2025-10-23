<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCity extends Component
{
    public City $city;

   

    public function mount(City $city)
    {
       $this->city = $city;
    }
    public function render()
    {
        return view('livewire.admin.cities.show-city');
    }
}
