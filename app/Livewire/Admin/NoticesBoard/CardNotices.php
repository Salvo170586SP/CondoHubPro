<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\Condominium;
use App\Models\NoticeBoard;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CardNotices extends Component
{
    use WithPagination;

    public Condominium $condominium;
    public $is_favorite = false;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount(Condominium $condominium)
    {
        $this->condominium = $condominium;
    }

    public function changeActive($notice_id)
    {
        $notice = NoticeBoard::findOrFail($notice_id);
        $notice->is_active = !$notice->is_active;
        $notice->save();
    }

    public function viewFavorite()
    {
        $this->is_favorite = !$this->is_favorite;
        $this->resetPage();
    }

    public function render()
    {
        $types = config('Condo.types');

        $noticesBoard = NoticeBoard::query();

        if ($this->search) {
            $noticesBoard = $noticesBoard->where('title', 'like', '%' . $this->search . '%');
        }

        if (!$this->is_favorite) {
            $noticesBoard = $noticesBoard->where('condominium_id', $this->condominium->id);
        } else {
            $noticesBoard = $noticesBoard->where('condominium_id', $this->condominium->id)
                ->where('is_active', true);
        }

        $noticesBoard = $noticesBoard->latest()->paginate(5);

        // total favorites count for this condominium (across all pages)
        $favoritesCount = NoticeBoard::where('condominium_id', $this->condominium->id)
            ->where('is_active', true)
            ->count();

        return view('livewire.admin.notices-board.card-notices', compact('noticesBoard', 'types', 'favoritesCount'));
    }
}
