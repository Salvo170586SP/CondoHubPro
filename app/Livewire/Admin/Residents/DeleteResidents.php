<?php

namespace App\Livewire\Admin\Residents;

use App\Models\User;
use Livewire\Component;

class DeleteResidents extends Component
{
    public User $resident;

    public function mount(User $resident)
    {
        $this->resident =  $resident;
    }

    public function deleteResident()
    {
        try {
            if ($this->resident) {
                $this->resident->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            return $this->redirect('/residents', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            return $this->redirect('/residents', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.residents.delete-residents');
    }
}
