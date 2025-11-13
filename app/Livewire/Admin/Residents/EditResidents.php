<?php

namespace App\Livewire\Admin\Residents;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditResidents extends Component
{
    use WithFileUploads;

    public User $resident;
    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;
    public $password;
    public $apartment_id;

    protected $rules = [
        'name' => 'required|string',
        'surname' => 'required|string',
        'phone_number' => 'nullable|numeric',
        'img_user' => 'nullable',
        'passsword' => 'nullable|min:5',
    ];

    protected $messages = [
        'name.required' => 'il campo è obbligatorio',
        'surname.required' => 'il campo è obbligatorio',
        'phone_number.numeric' => 'il campo deve contenere numeri',
        'passsword.min' => 'il campo deve avere minimo 5 caratteri',
    ];

    public function mount(User $resident)
    {
        $this->resident = $resident;
        $this->name = $resident->name;
        $this->surname = $resident->surname;
        $this->phone_number = $resident->phone_number;
        $this->img_user = $resident->img_user;
        $this->apartment_id = $resident->apartment ? $resident->apartment->id : null;
    }



    public function submit()
    {
        try {
            $url = $this->resident->img_user;
            if ($this->img_user && !is_string($this->img_user)) {
                if ($url) {
                    Storage::disk('public')->delete($url);
                }

                $url = $this->img_user->store('imgsUser', 'public');
            }

            $this->resident->update([
                'name' => $this->name,
                'surname' => $this->surname,
                'phone_number' => $this->phone_number,
                'img_user' => $url,
            ]);

            // Libera il vecchio appartamento (se esiste)
            if ($this->resident->apartment && $this->resident->apartment->id != $this->apartment_id) {
                $oldApartment = $this->resident->apartment;
                $oldApartment->resident_id = null;
                $oldApartment->save();
            }

            // Assegna il nuovo appartamento
            $newApartment = Apartment::findOrFail($this->apartment_id);
            $newApartment->resident_id = $this->resident->id;
            $newApartment->save();

            session()->flash('message', 'Elemento creato con successo!');
            Log::info('Modifica Residente - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            Log::error('Modifica Residente - Errore di modifica');
        }

        return $this->redirect('/admin/residents', navigate: true);
    }

    public function render()
    {
        $apartments = Apartment::where('resident_id', NULL)->get();
        return view('livewire.admin.residents.edit-residents', compact('apartments'));
    }
}
