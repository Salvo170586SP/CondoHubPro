<?php

namespace App\Livewire\Admin\Apartments;

use App\Models\Apartment;
use App\Models\Condominium;
use Livewire\Component;

class DeleteApartments extends Component
{
    public Condominium $condominium;
    public Apartment $apartment;

    public function mount(Apartment $apartment, Condominium $condominium)
    {
        $this->apartment =  $apartment;
        $this->condominium =  $condominium;
    }

    public function deleteApartment()
    {
        try {
            if ($this->apartment) {
                $this->apartment->delete();
            }

            $condominium_id = $this->condominium->id;
            session()->flash('messageApartment', 'Elemento eliminato con successo!');
            return $this->redirect("/admin/condominiums/$condominium_id/show", navigate: true);
        } catch (\Throwable $th) {
            $condominium_id = $this->condominium->id;
            session()->flash('errorApartment', 'Errore di eliminazione. Riprova.');
            return $this->redirect("/admin/condominiums/$condominium_id/show", navigate: true);
        }
    }
    public function render()
    {
        return view('livewire.admin.apartments.delete-apartments');
    }
}
