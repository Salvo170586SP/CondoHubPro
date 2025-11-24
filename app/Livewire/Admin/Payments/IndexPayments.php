<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPayments extends Component
{
    use WithPagination;

    public $search = '';
    public $search_pay;
    public $dateSearch = '';
    public $selected = [];
    public $areAllSelected = false;
    public $currentPageIds = [];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSearchPay()
    {
        $this->resetPage();
    }

    public function updatedDateSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->currentPageIds = [];
        $this->areAllSelected = false;
        $this->selected = [];
    }


    public function deleteSelected()
    {
        try {

            if (empty($this->selected)) {
                session()->flash('error', 'Nessun elemento selezionato.');
                return;
            }

            $ids = $this->selected;

            $payments = Payment::whereIn('id', $ids)->get();

            foreach ($payments as $payment) {
                $payment->delete();
            }

            $this->selected = [];
            $this->areAllSelected = false;

            session()->flash('message', "Elementi selezionati eliminati");
            Log::info('Eliminazione Selettiva Pagamenti - Operazione completata con successo');
            $this->resetPage();
        } catch (\Throwable $th) {
            Log::error('Eliminazione Selettiva Pagamenti - Errore di eliminazione');
        }
        
        return $this->redirect('/admin/payments', navigate: true);
    }

    public function deletePayment($payment_id)
    {
        try {
            $payment = Payment::findOrFail($payment_id);
            if ($payment) {
                if ($payment->url_pdf && Storage::disk('public')->exists($payment->url_pdf)) {
                    Storage::disk('public')->delete($payment->url_pdf);
                }

                $payment->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            Log::info('Eliminazione Agenda - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Agenda - Errore di eliminazione');
        }

        return $this->redirect('/admin/payments', navigate: true);
    }

    /**
     * Restituisce gli ID amministratore per la pagina correntemente impaginata (rispettando la ricerca).
     */
    protected function getCurrentPagePaymentIds(): array
    {
        return $this->currentPageIds ?? [];
    }

    /**
     * Quando cambia l'array di selezione per riga, aggiorna lo stato della casella di controllo dell'intestazione.
     */
    public function updatedSelected()
    {
        $ids = $this->getCurrentPagePaymentIds();
        $this->areAllSelected = !empty($ids) && count(array_diff($ids, $this->selected)) === 0;
    }

    /**
     * Quando la casella di controllo dell'intestazione (areAllSelected) è selezionata, aggiungi/rimuovi gli ID della pagina corrente.
     */
    public function updatedAreAllSelected($value)
    {
        $ids = $this->getCurrentPagePaymentIds();

        if ($value) {
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        } else {
            $this->selected = array_values(array_diff($this->selected, $ids));
        }
    }

    public function resetFilter()
    {
        $this->search = '';
        $this->dateSearch = '';
        $this->search_pay = false;
    }

    public function render()
    {
        $user = auth()->user();
        $payments = Payment::query();

        if ($this->search) {
            $payments = $payments->whereHas('resident', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->search_pay) {
            $payments = $payments->where('is_pay', 'like', '%' . $this->search_pay . '%');
        }

        if ($this->dateSearch) {
            $payments = $payments->where('date', 'like', '%' . $this->dateSearch . '%');
        }

        if ($user->hasRole('condomino')) {
            $payments = $payments->where('resident_id', Auth::id());
        } elseif ($user->hasRole('amministratore')) {

            $residentIds = $user->condominiums()
                ->with('apartments.resident')
                ->get()
                ->pluck('apartments.*.resident.id')
                ->filter()
                ->flatten()
                ->toArray();

            if (!empty($residentIds)) {
                $payments = $payments->whereIn('resident_id', $residentIds);
            } else {
                $payments = $payments->whereRaw('1 = 0');
            }
        }

        $payments = $payments->paginate(10);

        // memorizza nella cache gli ID delle pagine correnti in modo che gli hook non debbano chiamare di nuovo paginate()
        $this->currentPageIds = $payments->pluck('id')->toArray();
        $this->areAllSelected = !empty($this->currentPageIds) && count(array_diff($this->currentPageIds, $this->selected)) === 0;

        return view('livewire.admin.payments.index-payments', compact('payments'));
    }
}
