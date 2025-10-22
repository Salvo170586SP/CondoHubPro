<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAdministrators extends Component
{
    use WithPagination;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $administrators = User::query();

        if ($this->search) {
            $administrators = $administrators->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('surname', 'like', '%' . $this->search . '%');
        }

        $administrators = $administrators->role('amministratore')->latest()->paginate(10);

        return view('livewire.admin.administrators.index-administrators', compact('administrators'));
    }
}
