<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;

class CreateCity extends Component
{
    public $name_city = '';
    public $name_prov = '';


    public function resetForm()
    {
        $this->reset(['name_city', 'name_prov']);
        $this->resetValidation();
    }

    public function createCity()
    {
        $validate = $this->validate([
            'name_city' => 'required|max:20|string|unique:cities',
            'name_prov' => 'required|min:2|max:2|string|unique:cities'
        ], [
            'name_city.required' => 'il campo è obbligatorio',
            'name_prov.required' => 'il campo è obbligatorio',
            'name_city.max' => 'max 20 caratteri',
            'name_prov.max' => 'max 2 caratteri',
            'name_prov.min' => 'min 2 caratteri',
            'name_city.unique' => 'l\'elemento esiste già',
            'name_prov.unique' => 'l\'elemento esiste già'
        ]);

        try {
            City::create($validate);
            $this->resetForm();

            session()->flash('message', 'Elemento creato con successo!');
            return $this->redirect('/cities', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di creazione. Riprova.');
            return $this->redirect('/cities', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.cities.create-city');
    }
}
