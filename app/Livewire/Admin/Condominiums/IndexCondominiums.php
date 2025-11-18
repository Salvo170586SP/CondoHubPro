<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\City;
use App\Models\Condominium;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCondominiums extends Component
{
    use WithPagination;
    public $search = '';
    public $search_city = '';
    public $selected = [];
    public $areAllSelected = false;
    public $currentPageIds = [];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSearchCity()
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

            if (empty($this->selected)) {
                session()->flash('error', 'Nessun elemento selezionato.');
                return;
            }

            $ids = $this->selected;

            $condominiums = Condominium::whereIn('id', $ids)->get();

            foreach ($condominiums as $condominium) {
                $condominium->delete();
            }

            $this->selected = [];
            $this->areAllSelected = false;

            session()->flash('message', "Elementi selezionati eliminati");
            Log::info('Eliminazione Selettiva Condominio - Operazione completata con successo');
            $this->resetPage();
        } catch (\Throwable $th) {
            Log::error('Eliminazione Selettiva Condominio - Errore di eliminazione');
        }
    }



    /**
     * Restituisce gli ID amministratore per la pagina correntemente impaginata (rispettando la ricerca).
     */
    protected function getCurrentPageCondominiumIds(): array
    {
        return $this->currentPageIds ?? [];
    }

    /**
     * Quando cambia l'array di selezione per riga, aggiorna lo stato della casella di controllo dell'intestazione.
     */
    public function updatedSelected()
    {
        $ids = $this->getCurrentPageCondominiumIds();
        $this->areAllSelected = !empty($ids) && count(array_diff($ids, $this->selected)) === 0;
    }

    /**
     * Quando la casella di controllo dell'intestazione (areAllSelected) è selezionata, aggiungi/rimuovi gli ID della pagina corrente.
     */
    public function updatedAreAllSelected($value)
    {
        $ids = $this->getCurrentPageCondominiumIds();

        if ($value) {
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        } else {
            $this->selected = array_values(array_diff($this->selected, $ids));
        }
    }


    public function render()
    {
        $user = auth()->user();

        $condominiums = Condominium::query();

        if ($user->hasRole('condomino')) {
            $apartmentIds = $user->apartments?->pluck('condominium_id')->toArray() ?? [];
            if (!empty($apartmentIds)) {
                $condominiums->whereIn('id', $apartmentIds);
            } else {
                // Nessun condominio -> nessun risultato
                $condominiums->whereRaw('1 = 0');
            }
        } elseif ($user->hasRole('amministratore')) {
            $condominiumIds = $condominiums->where('administrator_id', $user->id);
        }


        if ($this->search) {
            $condominiums = $condominiums->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->search_city) {
            $condominiums = $condominiums->where('city_id', $this->search_city);
        }

        $condominiums = $condominiums->latest()->paginate(10);

        $cities = City::all();

        // memorizza nella cache gli ID delle pagine correnti in modo che gli hook non debbano chiamare di nuovo paginate()
        $this->currentPageIds = $condominiums->pluck('id')->toArray();
        $this->areAllSelected = !empty($this->currentPageIds) && count(array_diff($this->currentPageIds, $this->selected)) === 0;

        return view('livewire.admin.condominiums.index-condominiums', compact('condominiums', 'cities'));
    }
}
