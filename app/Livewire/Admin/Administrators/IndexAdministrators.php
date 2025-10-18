<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAdministrators extends Component
{
    use WithPagination;

    public function render()
    {
        $administrators = User::role('amministratore')->latest()->paginate(10);
        return view('livewire.admin.administrators.index-administrators', compact('administrators'));
    }
}
