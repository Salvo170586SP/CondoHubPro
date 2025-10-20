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
    }

    public function render()
    {
        $types = config('Condo.types');

        if (!$this->is_favorite) {
            $noticesBoard = NoticeBoard::where('condominium_id', $this->condominium->id)
                ->latest()
                ->paginate(10);
        } else {
            $noticesBoard = NoticeBoard::where('condominium_id', $this->condominium->id)
                ->where('is_active', true)
                ->latest()
                ->paginate(10);
        }

        return view('livewire.admin.notices-board.card-notices', compact('noticesBoard', 'types'));
    }
}
