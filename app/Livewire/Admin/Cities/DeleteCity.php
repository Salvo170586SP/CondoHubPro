<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;

class DeleteCity extends Component
{
    public City $city;

    public function mount(City $city)
    {
        $this->city =  $city;
    }

    public function deleteCity()
    {
        try {
            if ($this->city) {
                $this->city->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            return $this->redirect('/admin/cities', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            return $this->redirect('/admin/cities', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.cities.delete-city');
    }
}
