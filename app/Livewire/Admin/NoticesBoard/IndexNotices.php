<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\Condominium;
use App\Models\NoticeBoard;
use Livewire\Component;

class IndexNotices extends Component
{
    public Condominium $condominium;
    
    public function render()
    {
        $noticesBoardCount = NoticeBoard::where('condominium_id', $this->condominium->id)->count();

        return view('livewire.admin.notices-board.index-notices', compact('noticesBoardCount'));
    }
}
