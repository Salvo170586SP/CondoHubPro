<?php

namespace App\Livewire\Admin\Apartments;

use App\Models\Apartment;
use App\Models\Condominium;
use App\Models\User;
use Livewire\Component;

class EditApartments extends Component
{
    public Apartment $apartment;
    public Condominium $condominium;
    public $name = '';
    public $unit_number = '';
    public $floor = '';
    public $square_metres;
    public $rooms;
    public $resident_id;

    public function mount(Apartment $apartment, Condominium $condominium)
    {
        $this->apartment = $apartment;
        $this->condominium = $condominium;
        $this->name = $apartment->name;
        $this->unit_number = $apartment->unit_number;
        $this->floor = $apartment->floor;
        $this->square_metres = $apartment->square_metres;
        $this->rooms = $apartment->rooms;
        $this->resident_id = $apartment->resident_id;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|max:30|string',
            'unit_number' => 'nullable|string',
            'floor' => 'required|string',
            'square_metres' => 'required|numeric',
            'rooms' => 'required|numeric',
            'resident_id' => 'nullable',
        ], [
            'name.required' => 'il campo è obbligatorio',
            'name.max' => 'il campo deve contenere massimo 30 caratteri',
            'floor.required' => 'il campo è obbligatorio',
            'square_metres.required' => 'il campo è obbligatorio',
            'square_metres.numeric' => 'il campo può contenere solo numeri',
            'rooms.required' => 'il campo è obbligatorio',
            'rooms.numeric' => 'il campo può contenere solo numeri',
        ]);

        try {
            $this->apartment->update([
                'resident_id' => $this->resident_id,
                'name' => $this->name,
                'floor' => $this->floor,
                'square_metres' => $this->square_metres,
                'rooms' => $this->rooms,
                'unit_number' => $this->unit_number
            ]);

            $condominium_id = $this->condominium->id;
            session()->flash('messageApartment', 'Elemento modificato con successo!');
            return $this->redirect("/admin/condominiums/$condominium_id/show", navigate: true);
        } catch (\Throwable $th) {
            $condominium_id = $this->condominium->id;
            session()->flash('errorApartment', 'Errore di creazione. Riprova.');
            return $this->redirect("/admin/condominiums/$condominium_id/show", navigate: true);
        }
    }

    public function render()
    {
        $residents = User::role('condomino')->get();
        $condominiums = Condominium::all();
        return view('livewire.admin.apartments.edit-apartments', compact('residents', 'condominiums'));
    }
}
