<?php

namespace App\Livewire\Admin;

use App\Models\NoticeBoard;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $residents = User::role('condomino')->latest()->get();
        $administrators = User::role('amministratore')->latest()->get();
        $noticeBoards = NoticeBoard::latest()->get();
        $types = config('Condo.types');

        return view('livewire.admin.dashboard', compact('residents', 'administrators', 'noticeBoards', 'types'));
    }
}
