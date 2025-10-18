<?php

namespace App\Livewire\Admin\Apartments;

use App\Models\Apartment;
use Livewire\Component;

class IndexApartments extends Component
{
    public function render()
    {
        $apartments = Apartment::latest()->paginate(10);
        return view('livewire.admin.apartments.index-apartments', compact('apartments'));
    }
}
