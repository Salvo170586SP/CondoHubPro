<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\User;
use Livewire\Component;

class DeleteAdministrator extends Component
{
    public User $administrator;

    public function mount(User $administrator)
    {
        $this->administrator =  $administrator;
    }

    public function deleteAdministrator()
    {
        try {
            if ($this->administrator) {
                $this->administrator->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            return $this->redirect('/administrators', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            return $this->redirect('/administrators', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.administrators.delete-administrator');
    }
}
