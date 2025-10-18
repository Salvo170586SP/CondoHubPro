<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\City;
use App\Models\Condominium;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateCondominiums extends Component
{
    public $name = '';
    public $address = '';
    public $cap = '';
    public $city_id = null;
    public $administrator_id = null;

    public function submit()
    {
        $this->validate([
            'name' => 'required|max:20|string',
            'address' => 'required|min:2|max:50|string',
            'cap' => 'required|numeric',
            'city_id' => 'required',
        ], [
            'name.required' => 'il campo è obbligatorio',
            'address.required' => 'il campo è obbligatorio',
            'name.max' => 'max 20 caratteri',
            'address.min' => 'min 2 caratteri',
            'address.max' => 'max 50 caratteri',
            'cap.max' => 'il campo è obbligatorio',
            'cap.numeric' => 'il campo deve contenere numeri',
            'city_id.required' => 'il campo è obbligatorio',
        ]);

        try {
            Condominium::create([
                'city_id' => $this->city_id,
                'administrator_id' => Auth::id(),
                'name' => $this->name,
                'address' => $this->address,
                'cap' => $this->cap
            ]);

            session()->flash('message', 'Elemento creato con successo!');
            return $this->redirect('/condominiums', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            return $this->redirect('/condominiums', navigate: true);
        }
    }

    public function render()
    {
        $cities = City::all();
        return view('livewire.admin.condominiums.create-condominiums', compact('cities'));
    }
}
