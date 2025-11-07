<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Apartment;
use App\Models\Condominium;
use Livewire\Component;
use Livewire\WithPagination;

class TableApartments extends Component
{
    use WithPagination;

    public Condominium $condominium;
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

        try {
            $ids = $this->selected;

            $apartments = Apartment::whereIn('id', $ids)->get();

            foreach ($apartments as $apartment) {
                $apartment->update([
                    'condominium_id' => NULL
                ]);
            }

            $this->selected = [];
            $this->areAllSelected = false;

            session()->flash('message', "Elementi selezionati eliminati");     
            $this->resetPage();

        } catch (\Throwable $th) {
            session()->flash('errorApartment', 'Errore di creazione. Riprova.');
        }
    }

    /**
     * Restituisce gli ID amministratore per la pagina correntemente impaginata (rispettando la ricerca).
     */
    protected function getCurrentPageApartmentIds(): array
    {
        return $this->currentPageIds ?? [];
    }

    /**
     * Quando cambia l'array di selezione per riga, aggiorna lo stato della casella di controllo dell'intestazione.
     */
    public function updatedSelected()
    {
        $ids = $this->getCurrentPageApartmentIds();
        $this->areAllSelected = !empty($ids) && count(array_diff($ids, $this->selected)) === 0;
    }

    /**
     * Quando la casella di controllo dell'intestazione (areAllSelected) è selezionata, aggiungi/rimuovi gli ID della pagina corrente.
     */
    public function updatedAreAllSelected($value)
    {
        $ids = $this->getCurrentPageApartmentIds();

        if ($value) {
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        } else {
            $this->selected = array_values(array_diff($this->selected, $ids));
        }
    }

    public function render()
    {
        $apartments = Apartment::query();

        if ($this->search) {
            $apartments = $apartments->where('name', 'like', '%' . $this->search . '%');
        }

        $apartments = $apartments->where('condominium_id', $this->condominium->id)->latest()->paginate(5);
        // memorizza nella cache gli ID delle pagine correnti in modo che gli hook non debbano chiamare di nuovo paginate()
        $this->currentPageIds = $apartments->pluck('id')->toArray();
        $this->areAllSelected = !empty($this->currentPageIds) && count(array_diff($this->currentPageIds, $this->selected)) === 0;

        return view('livewire.admin.condominiums.table-apartments', compact('apartments'));
    }
}
