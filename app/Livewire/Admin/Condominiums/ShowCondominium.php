<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Apartment;
use App\Models\Condominium;
use App\Models\Feedback;
use App\Models\NoticeBoard;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ShowCondominium extends Component
{
    use WithPagination;

    public Condominium $condominium;

    public function render()
    {
        $noticesBoardCount = NoticeBoard::where('condominium_id', $this->condominium->id)->count();
        $apartmentsCount = Apartment::where('condominium_id', $this->condominium->id)->count();
        $feedbooksCount = Feedback::where('condominium_id', $this->condominium->id)->count();

        return view('livewire.admin.condominiums.show-condominium', compact('apartmentsCount', 'noticesBoardCount', 'feedbooksCount'));
    }
}
