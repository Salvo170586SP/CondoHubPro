<?php

namespace App\Livewire\Admin\Apartments;

use App\Models\Apartment;
use Livewire\Component;

class DeleteApartments extends Component
{
    public Apartment $apartment;

    public function mount(Apartment $apartment)
    {
        $this->apartment =  $apartment;
    }

    public function deleteApartment()
    {
        try {
            if ($this->apartment) {
                $this->apartment->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            return $this->redirect('/apartments', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            return $this->redirect('/apartments', navigate: true);
        }
    }
    public function render()
    {
        return view('livewire.admin.apartments.delete-apartments');
    }
}
