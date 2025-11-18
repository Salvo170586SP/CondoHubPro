<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPayments extends Component
{
    use WithFileUploads;

    public Payment $payment;
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

    public function mount(Payment $payment)
    {
        $this->payment = $payment;
        $this->resident_id = $payment->resident_id;
        $this->url_pdf = $payment->url_pdf;
        $this->name_file = $payment->name_file;
        $this->note = $payment->note;
        $this->price = $payment->price;
        $this->date = $payment->date->format('Y-m-d');
        $this->is_pay = $payment->is_pay;
    }

    public function submit()
    {
        $this->validate();

        try {
            $url = $this->payment->url_pdf;
            $nameFile =  $this->payment->name_file;

            if ($this->url_pdf) {
                if ($this->payment->url_pdf && Storage::disk('public')->exists($this->payment->url_pdf)) {
                    Storage::disk('public')->delete($this->payment->url_pdf);
                }

                $nameFile = $this->url_pdf->getClientOriginalName();
                $url = $this->url_pdf->store('pdfsPayment', 'public');
            }

            $this->payment->update([
                'resident_id' => $this->resident_id,
                'url_pdf' => $url,
                'name_file' => $nameFile,
                'note' => $this->note,
                'price' => $this->price,
                'date' => $this->date,
                'is_pay' => $this->is_pay,
            ]);

            session()->flash('message', 'Elemento modificato con successo!');
            Log::info('Modifica Pagamento - Operazione completata con successo');
        } catch (\Throwable $th) {
            Log::error('Modifica Pagamento - Errore di modifica');
            session()->flash('error', 'Errore di modifica. Riprova.');
        }

        return $this->redirect('/admin/payments', navigate: true);
    }

    public function render()
    {
        $residents = User::role('condomino')->get();
        return view('livewire.admin.payments.edit-payments', compact('residents'));
    }
}
