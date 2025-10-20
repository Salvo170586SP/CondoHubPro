<?php

namespace App\Livewire\Admin\NoticesBoard;

use App\Models\NoticeBoard;
use Livewire\Component;

class ShowNotices extends Component
{
    public $notice;

    public function mount(NoticeBoard $notice)
    {
        $this->notice =  $notice;
    }

    public function render()
    {
        return view('livewire.admin.notices-board.show-notices');
    }
}
