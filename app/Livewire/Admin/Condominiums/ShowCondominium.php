<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Apartment;
use App\Models\Condominium;
use App\Models\NoticeBoard;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCondominium extends Component
{
    use WithPagination;

    public Condominium $condominium;

    public function render()
    {
        $noticesBoardCount = NoticeBoard::where('condominium_id', $this->condominium->id)->count();
        $apartmentsCount = Apartment::where('condominium_id', $this->condominium->id)->count();
        return view('livewire.admin.condominiums.show-condominium', compact('apartmentsCount','noticesBoardCount'));
    }
}
