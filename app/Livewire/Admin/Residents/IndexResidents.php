<?php

namespace App\Livewire\Admin\Residents;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexResidents extends Component
{
    use WithPagination;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $residents = User::query();

        if ($this->search) {
            $residents = $residents->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('surname', 'like', '%' . $this->search . '%');
        }

        $residents = $residents->role('condomino')->with('apartment')->paginate(10);

        return view('livewire.admin.residents.index-residents', compact('residents'));
    }
}
