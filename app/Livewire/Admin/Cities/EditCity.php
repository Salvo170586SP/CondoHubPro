<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;

class EditCity extends Component
{
    public City $city;
    public $name_city;
    public $name_prov;

    public function mount(City $city)
    {
        $this->city = $city;
        $this->name_city = $city->name_city;
        $this->name_prov = $city->name_prov;
    }


    public function resetForm()
    {
        $this->resetValidation();
        $this->name_city = $this->city->name_city;
        $this->name_prov = $this->city->name_prov;
    }

    public function editCity($city_id)
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
            $city = City::findOrFail($city_id);

            if ($city) {
                $city->update($validate);
            }

            session()->flash('message', 'Elemento modificato con successo!');
            return $this->redirect('/cities', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di creazione. Riprova.');
            return $this->redirect('/cities', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.cities.edit-city');
    }
}
