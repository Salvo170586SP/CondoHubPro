<?php

namespace App\Livewire\Admin\Apartments;

use App\Models\Apartment;
use App\Models\Condominium;
use App\Models\User;
use Livewire\Component;

class CreateApartments extends Component
{
    public Condominium $condominium;
    public $selectedApartment = [];

    public function rules()
    {
        return [
            'selectedApartment' => 'required|array',
            'selectedApartment.*' => 'integer|exists:apartments,id',
        ];
    }

    public function messages()
    {
        return [
            'selectedApartment.required' => 'Seleziona un appartamento',
            'selectedApartment.exists' => 'L\'appartamento selezionato non è valido',
        ];
    }

    public function submit()
    {
        $this->validate();

        try {
            foreach ($this->selectedApartment as $apartment_id) {
                $apartment =  Apartment::findOrFail($apartment_id);
                $apartment->update(['condominium_id' => $this->condominium->id]);
            }

            session()->flash('messageApartment', 'Elemento creato con successo!');
        } catch (\Throwable $th) {
            session()->flash('errorApartment', 'Errore di creazione. Riprova.');
        }

        $condominium_id = $this->condominium->id;
        return $this->redirect("/admin/condominiums/$condominium_id/show", navigate: true);
    }

    public function render()
    {
        $apartments = Apartment::whereNull('condominium_id')->paginate(10);
        return view('livewire.admin.apartments.create-apartments', compact('apartments'));
    }
}
