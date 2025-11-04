<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class IndexFeedbacks extends Component
{
    use WithPagination;

    public Condominium $condominium;
    public $search = '';
    public $filterPriority = '';
    public $selected = [];
    public $areAllSelected = false;
    protected $suppressAreAllSelectedHook = false;
    public $currentPageIds = [];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterPriority()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->currentPageIds = [];
        $this->suppressAreAllSelectedHook = true;
        $this->areAllSelected = false;
        $this->suppressAreAllSelectedHook = false;
    }


    public function deleteSelected()
    {
        try {
            if (empty($this->selected)) {
                session()->flash('error', 'Nessun elemento selezionato.');
                return;
            }

            $ids = $this->selected;

            $feedbacks = Feedback::whereIn('id', $ids)->get();

            foreach ($feedbacks as $feedback) {
                $feedback->delete();
            }

            $this->selected = [];
            $this->areAllSelected = false;

            session()->flash('messageFeedback', "Elementi selezionati eliminati");

            $this->resetPage();
        } catch (\Throwable $th) {
            session()->flash('errorFeedback', 'Errore di eliminazione. Riprova.');
        }
    }

    /**
     * Seleziona tutti gli amministratori nella pagina corrente.
     * Se non sono selezionati tutti gli ID delle pagine correnti, aggiungili; altrimenti rimuovili.
     */
    public function toggleSelectAll()
    {
        $ids = $this->getCurrentPageFeedbackIds();

        // se non hai ids selezionati, selezionali tutti, altrimenti rimuovi tutti  nella pagina corrente
        if (count(array_diff($ids, $this->selected)) > 0) {
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        } else {
            $this->selected = array_values(array_diff($this->selected, $ids));
        }
    }

    /**
     * Restituisce gli ID amministratore per la pagina correntemente impaginata (rispettando la ricerca).
     */
    protected function getCurrentPageFeedbackIds(): array
    {
        $query = Feedback::query();

        if ($this->search) {
            $query = $query->where('title', 'like', '%' . $this->search . '%');
        }

        $ids = $query->latest()->paginate(10)->pluck('id')->toArray();

        return $ids;
    }

    /**
     * Quando cambia l'array di selezione per riga, aggiorna lo stato della casella di controllo dell'intestazione.
     */
    public function updatedSelected()
    {
        $ids = $this->currentPageIds;
        $shouldBeAll = empty($ids) ? false : count(array_diff($ids, $this->selected)) === 0;

        // update header state without triggering the header hook
        $this->suppressAreAllSelectedHook = true;
        $this->areAllSelected = $shouldBeAll;
        $this->suppressAreAllSelectedHook = false;
    }

    /**
     * Quando la casella di controllo dell'intestazione (areAllSelected) è selezionata, aggiungi/rimuovi gli ID della pagina corrente.
     */
    public function updatedAreAllSelected($value)
    {
        if ($this->suppressAreAllSelectedHook) {
            return;
        }

        $ids = $this->currentPageIds;

        if ($value) {
            // l'utente ha cliccato sull'intestazione per controllarla: unisci gli ID visibili nella selezione (non cancellare le altre selezioni)
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        } else {
            // l'utente ha cliccato sull'intestazione per deselezionarla: cancella l'intera matrice di selezione
            $this->selected = [];
        }
    }

    public function render()
    {
        $priorities = config('Condo.priorities');

        $feedbacks = Feedback::query();

        if ($this->search) {
            $feedbacks = $feedbacks->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterPriority) {
            $feedbacks = $feedbacks->where('priority', $this->filterPriority);
        }

        $feedbacks = $feedbacks->where('condominium_id', $this->condominium->id)->latest()->paginate(5);
        $this->currentPageIds = $feedbacks->pluck('id')->toArray();


        return view('livewire.admin.feedbacks.index-feedbacks', compact('feedbacks', 'priorities'));
    }
}
