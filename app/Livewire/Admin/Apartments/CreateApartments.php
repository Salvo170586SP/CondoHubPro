<?php

namespace App\Livewire\Admin\Apartments;

use App\Models\Apartment;
use App\Models\Condominium;
use App\Models\User;
use Livewire\Component;

class CreateApartments extends Component
{
    public $name = '';
    public $unit_number = '';
    public $floor = '';
    public $square_metres;
    public $rooms;
    public $resident_id;
    public $condominium_id;

    public function submit()
    {
        $this->validate([
            'name' => 'required|max:30|string',
            'unit_number' => 'nullable|string',
            'floor' => 'required|string',
            'square_metres' => 'required|numeric',
            'rooms' => 'required|numeric',
            'condominium_id' => 'required',
            'resident_id' => 'nullable',
        ], [
            'name.required' => 'il campo è obbligatorio',
            'name.max' => 'il campo deve contenere massimo 30 caratteri',
            'floor.required' => 'il campo è obbligatorio',
            'square_metres.required' => 'il campo è obbligatorio',
            'square_metres.numeric' => 'il campo può contenere solo numeri',
            'rooms.required' => 'il campo è obbligatorio',
            'rooms.numeric' => 'il campo può contenere solo numeri',
            'condominium_id.required' => 'il campo è obbligatorio',
        ]);

        try {
            Apartment::create([
                'condominium_id' => $this->condominium_id,
                'resident_id' => $this->resident_id,
                'name' => $this->name,
                'floor' => $this->floor,
                'square_metres' => $this->square_metres,
                'rooms' => $this->rooms,
                'unit_number' => $this->unit_number
            ]);

            session()->flash('message', 'Elemento creato con successo!');
            return $this->redirect('/apartments', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            return $this->redirect('/apartments', navigate: true);
        }
    }

    public function render()
    {
        $residents = User::role('condomino')->get();
        $condominiums = Condominium::all();
        return view('livewire.admin.apartments.create-apartments', compact('residents', 'condominiums'));
    }
}
