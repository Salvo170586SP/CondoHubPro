<?php

namespace App\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCities extends Component
{
    use WithPagination;
    public $search = '';
    public $selected = [];
    public $areAllSelected = false;
    public $currentPageIds = [];


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->currentPageIds = [];
        $this->areAllSelected = false;
        $this->selected = [];
    }


    public function deleteSelected()
    {
        if (empty($this->selected)) {
            session()->flash('error', 'Nessun elemento selezionato.');
            return;
        }

        $ids = $this->selected;

        $cities = City::whereIn('id', $ids)->get();

        foreach ($cities as $city) {
            $city->delete();
        }

        $this->selected = [];
        $this->areAllSelected = false;

        session()->flash('message', "Elementi selezionati eliminati");

        $this->resetPage();
    }


    /**
     * Restituisce gli ID amministratore per la pagina correntemente impaginata (rispettando la ricerca).
     */
    protected function getCurrentPageCityIds(): array
    {
        return $this->currentPageIds ?? [];
    }

    /**
     * Quando cambia l'array di selezione per riga, aggiorna lo stato della casella di controllo dell'intestazione.
     */
    public function updatedSelected()
    {
        $ids = $this->getCurrentPageCityIds();
        $this->areAllSelected = !empty($ids) && count(array_diff($ids, $this->selected)) === 0;
    }

    /**
     * Quando la casella di controllo dell'intestazione (areAllSelected) è selezionata, aggiungi/rimuovi gli ID della pagina corrente.
     */
    public function updatedAreAllSelected($value)
    {
        $ids = $this->getCurrentPageCityIds();

        if ($value) {
            //  aggiungi ID visibili alla selezione
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        } else {
            // rimuovi ID visibili alla selezione
            $this->selected = array_values(array_diff($this->selected, $ids));
        }
    }

    public function render()
    {
        $cities = City::query();

        if ($this->search) {
            $cities = $cities->where('name_city', 'like', '%' . $this->search . '%');
        }

        $cities = $cities->latest()->paginate(10);

        // memorizza nella cache gli ID delle pagine correnti in modo che gli hook non debbano chiamare di nuovo paginate()
        $this->currentPageIds = $cities->pluck('id')->toArray();

        // mi assicuro che la casella di controllo dell'intestazione rifletta la pagina corrente
        $this->areAllSelected = !empty($this->currentPageIds) && count(array_diff($this->currentPageIds, $this->selected)) === 0;
     
        return view('livewire.admin.cities.index-cities', compact('cities'));
    }
}
