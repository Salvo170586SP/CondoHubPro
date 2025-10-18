<?php

namespace App\Livewire\Admin\Residents;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexResidents extends Component
{
    use WithPagination;

    public function render()
    {
        $residents = User::role('condomino')->with('apartment')->paginate(10);
        return view('livewire.admin.residents.index-residents', compact('residents'));
    }
}
