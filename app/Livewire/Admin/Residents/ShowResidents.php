<?php

namespace App\Livewire\Admin\Residents;

use App\Models\User;
use Livewire\Component;

class ShowResidents extends Component
{
    public User $resident;

  /*   public function mount(User $resident)
    {
        $this->resident =  $resident;
    } */

    public function render()
    {
        return view('livewire.admin.residents.show-residents');
    }
}
