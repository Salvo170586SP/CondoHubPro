<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Illuminate\Support\Facades\Log;
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
            Log::info('Eliminazione Città - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Città - Errore di eliminazione');
        }

        return $this->redirect('/admin/cities', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.cities.delete-city');
    }
}
