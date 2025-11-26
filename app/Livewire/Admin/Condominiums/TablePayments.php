<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Condominium;
use App\Models\Payment;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class TablePayments extends Component
{
    public Condominium $condominium;

    public function generatePdf()
    {
        $condominium = $this->condominium->load([
            'apartments.resident.payments' => function ($query) {
                $query->orderBy('date', 'desc');
            },
            'apartments.resident'
        ]);

        $residents = User::whereHas('apartments', function ($query) use ($condominium) {
            $query->where('condominium_id', $condominium->id);
        })->with(['payments' => function ($query) {
            $query->orderBy('date', 'desc');
        }, 'apartments'])->get();

        $pdf = Pdf::loadView('livewire.admin.pdfs.invoice', [
            'condominium' => $condominium,
            'residents' => $residents
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'pagamenti-' . $condominium->name . '.pdf');
    }

    public function render()
    {
        // Recupera tutti i pagamenti dei residenti del condominio
        $condominiumPayments = Payment::whereHas('resident.apartments', function ($query) {
            $query->where('condominium_id', $this->condominium->id);
        })
            ->with(['resident.apartments' => function ($query) {
                $query->where('condominium_id', $this->condominium->id);
            }])
            ->orderBy('date', 'desc')
            ->paginate(5);

        return view('livewire.admin.condominiums.table-payments', compact('condominiumPayments'));
    }
}
