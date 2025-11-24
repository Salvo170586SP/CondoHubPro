<?php

namespace App\Livewire\Admin\Apartments;

use App\Models\Apartment;
use App\Models\Condominium;
use Illuminate\Support\Facades\Log;
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
                $this->apartment->update([
                    'condominium_id' => NULL
                ]);
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            Log::info('Eliminazione Appartamento - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Appartamento - Errore di eliminazione');
        }

        $condominium_id = $this->condominium->id;
        return $this->redirect("/admin/condominiums/$condominium_id/show", navigate: true);
    }
    public function render()
    {
        return view('livewire.admin.apartments.delete-apartments');
    }
}
