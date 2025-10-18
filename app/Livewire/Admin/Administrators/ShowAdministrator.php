<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\Condominium;
use App\Models\User;
use Livewire\Component;

class ShowAdministrator extends Component
{
    
    public User $administrator;
    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;
 
    /* public function mount(User $administrator)
    {
        $this->administrator = $administrator;
        $this->name = $administrator->name;
        $this->surname = $administrator->surname;
        $this->phone_number = $administrator->phone_number;
        $this->img_user = $administrator->img_user;
    } */

    public function render()
    {
        $condominiums = Condominium::where('administrator_id', $this->administrator->id)->latest()->paginate();
        return view('livewire.admin.administrators.show-administrator', compact('condominiums'));
    }
}
