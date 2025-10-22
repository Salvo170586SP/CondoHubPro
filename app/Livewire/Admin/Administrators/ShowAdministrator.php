<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\Condominium;
use App\Models\User;
use Livewire\Component;

class ShowAdministrator extends Component
{

    public User $administrator;
    public $search = '';
    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;

    public function render()
    {
        $condominiums = Condominium::query();

        if ($this->search) {
            $condominiums = $condominiums->where('name', 'like', '%' . $this->search . '%');
        }

        $condominiums = $condominiums->where('administrator_id', $this->administrator->id)->latest()->paginate();
        return view('livewire.admin.administrators.show-administrator', compact('condominiums'));
    }
}
