<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAdministrators extends Component
{
    use WithPagination;

    public $search = '';
    public $selected = [];
    public $areAllSelected = false;
    public $currentPageIds = [];

    public function mount()
    {
        $this->currentPageIds = [];
        $this->areAllSelected = false;
        $this->selected = [];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function deleteSelected()
    {
        if (empty($this->selected)) {
            session()->flash('error', 'Nessun elemento selezionato.');
            return;
        }

        $ids = $this->selected;

        $users = User::whereIn('id', $ids)->role('amministratore')->get();
 
        foreach ($users as $user) {
            $user->delete();
        }

        $this->selected = [];
        $this->areAllSelected = false;

        session()->flash('message', "Elementi elementi eliminati!");

        $this->resetPage();
    }

    /**
     * Return the cached current page ids (render() populates them).
     */
    protected function getCurrentPageAdministratorIds(): array
    {
        return $this->currentPageIds ?? [];
    }

    /**
     * When user toggles per-row selection, recompute header checkbox state.
     */
    public function updatedSelected()
    {
        $ids = $this->getCurrentPageAdministratorIds();
        $this->areAllSelected = !empty($ids) && count(array_diff($ids, $this->selected)) === 0;
    }

    /**
     * When header checkbox toggled by user: select or deselect current page ids.
     */
    public function updatedAreAllSelected($value)
    {
        $ids = $this->getCurrentPageAdministratorIds();

        if ($value) {
            // check: add visible ids to selection
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        } else {
            // uncheck: remove visible ids from selection
            $this->selected = array_values(array_diff($this->selected, $ids));
        }
    }

    public function render()
    {
        $administrators = User::query();

        if ($this->search) {
            $administrators = $administrators->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('surname', 'like', '%' . $this->search . '%');
        }

        $administrators = $administrators->role('amministratore')->latest()->paginate(10);

        // cache current page ids so hooks don't need to call paginate() again
        $this->currentPageIds = $administrators->pluck('id')->toArray();

        // ensure header checkbox reflects current selection
        $this->areAllSelected = !empty($this->currentPageIds) && count(array_diff($this->currentPageIds, $this->selected)) === 0;

        return view('livewire.admin.administrators.index-administrators', compact('administrators'));
    }
}
