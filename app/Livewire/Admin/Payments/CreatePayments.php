<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Document;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePayments extends Component
{
    use WithFileUploads;

    public $resident_id = null;
    public $url_pdf = null;
    public $name_file = null;
    public $note = '';
    public $price = null;
    public $date = null;
    public $is_pay = false;

    protected $rules = [
        'resident_id' => 'required',
        'url_pdf' => 'nullable',
        'name_file' => 'nullable',
        'note' => 'nullable',
        'price' => 'required|numeric',
        'date' => 'required|date',
    ];

    protected $messages = [
        'resident_id.required' => 'il campo è obbligatorio',
        'price.required' => 'il campo è obbligatorio',
        'price.numeric' => 'il campo deve contenere numeri',
        'date.required' => 'il campo è obbligatorio',
        'date.date' => 'inserisci data valida',
    ];

    public function submit()
    {
        $this->validate();

        try {

            $payment = Payment::create([
                'resident_id' => $this->resident_id,
                'note' => $this->note,
                'price' => $this->price,
                'date' => $this->date,
                'is_pay' => $this->is_pay,
            ]);

            $url = null;
            $nameFile = null;
            $mimeType = null;
            if ($this->url_pdf) {
                $nameFile = $this->url_pdf->getClientOriginalName();
                $url = $this->url_pdf->store('pdfsPayment', 'public');
                $mimeType = $this->url_pdf->getMimeType();

                Document::create([
                    'uploaded_by' => Auth::id(),
                    'condominium_id' => $payment->resident->apartment->condominium->id ?? null,
                    'payment_id' => $payment->id,
                    'name_file' => $nameFile,
                    'url_pdf' => $url,
                    'mime_type' => $mimeType,
                ]);
            }

            session()->flash('message', 'Elemento creato con successo!');
            Log::info('Creazione Pagamento - Operazione completata con successo');
        } catch (\Throwable $th) {
            Log::error('Creazione Pagamento - Errore di creazione');
            session()->flash('error', 'Errore di creazione. Riprova.');
        }

        return $this->redirect('/admin/payments', navigate: true);
    }

    public function render()
    {
        $residents = User::role('condomino')->get();
        return view('livewire.admin.payments.create-payments', compact('residents'));
    }
}
