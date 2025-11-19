<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Document;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
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
            $this->payment->update([
                'resident_id' => $this->resident_id,
                'note' => $this->note,
                'price' => $this->price,
                'date' => $this->date,
                'is_pay' => $this->is_pay,
            ]);

            $resident = User::find($this->resident_id);
            $resident_condominium_id  = $resident?->apartment?->condominium?->id ?? null;
            
            $document = $this->payment->document;
            // SE è arrivato un nuovo file
            if ($this->url_pdf instanceof TemporaryUploadedFile) {
                if ($document  && Storage::disk('public')->exists($document->url_pdf)) {
                    Storage::disk('public')->delete($document->url_pdf);
                }

                $nameFile = $this->url_pdf->getClientOriginalName();
                $mimeType = $this->url_pdf->getMimeType();
                $url = $this->url_pdf->store('pdfsPayment', 'public');

                if ($document) {
                    $document->update([
                        'uploaded_by' => Auth::id(),
                        'condominium_id' => $resident_condominium_id  ?? null,
                        'name_file' => $nameFile,
                        'url_pdf' => $url,
                        'mime_type' => $mimeType,
                    ]);
                } else {
                    Document::create([
                        'uploaded_by' => Auth::id(),
                        'condominium_id' => $resident_condominium_id  ?? null,
                        'payment_id' => $this->payment->id,
                        'name_file' => $nameFile,
                        'url_pdf' => $url,
                        'mime_type' => $mimeType,
                    ]);
                }
            } else {
                // Se non c’è nuovo file, aggiorno comunque il condominium_id
                if ($document) {
                    $document->update([
                        'condominium_id' => $resident_condominium_id,
                    ]);
                }
            }

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
