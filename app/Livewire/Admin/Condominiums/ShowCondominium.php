<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Condominium;
use Livewire\Component;

class ShowCondominium extends Component
{
    public Condominium $condominium;

    public function render()
    {
        return view('livewire.admin.condominiums.show-condominium');
    }
}
