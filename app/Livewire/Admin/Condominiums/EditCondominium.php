<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\City;
use App\Models\Condominium;
use Livewire\Component;

class EditCondominium extends Component
{

    public Condominium $condominium;
    public $name = '';
    public $address = '';
    public $cap = '';
    public $city_id = null;
    public $administrator_id = null;

    public function mount(Condominium $condominium)
    {
        $this->condominium = $condominium;
        $this->name = $condominium->name;
        $this->address = $condominium->address;
        $this->cap = $condominium->cap;
        $this->city_id = $condominium->city_id;
    }

    public function editCondominum()
    {
        $this->validate([
            'name' => 'required|max:20|string',
            'address' => 'required|min:2|max:50|string',
            'cap' => 'required|numeric',
            'city_id' => 'required',
            /* 'administrator_id' => 'required', */
        ], [
            'name.required' => 'il campo è obbligatorio',
            'address.required' => 'il campo è obbligatorio',
            'name.max' => 'max 20 caratteri',
            'address.min' => 'min 2 caratteri',
            'address.max' => 'max 50 caratteri',
            'cap.max' => 'il campo è obbligatorio',
            'cap.numeric' => 'il campo deve contenere numeri',
            'city_id.required' => 'il campo è obbligatorio',
            /* 'administrator_id.required' => 'il campo è obbligatorio', */
        ]);

        try {

            $this->condominium->update([
                'city_id' => $this->city_id,
                'name' => $this->name,
                'address' => $this->address,
                'cap' => $this->cap
            ]);


            session()->flash('message', 'Elemento modificato con successo!');
            return $this->redirect('/condominiums', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di creazione. Riprova.');
            return $this->redirect('/condominiums', navigate: true);
        }
    }

    public function render()
    {
        $cities = City::all();
        return view('livewire.admin.condominiums.edit-condominium', compact('cities'));
    }
}
