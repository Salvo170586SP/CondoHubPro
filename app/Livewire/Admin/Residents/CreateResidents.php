<?php

namespace App\Livewire\Admin\Residents;

use App\Livewire\Forms\Residents\Create\Step1;
use App\Livewire\Forms\Residents\Create\Step2;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateResidents extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Step1 $residentStep1;
    public Step2 $residentStep2;
    public $currentStep = 1;

    public function addStep()
    {
        if ($this->currentStep === 1) {
            $this->residentStep1->validate();
        } elseif ($this->currentStep === 2) {
            $this->residentStep2->validate();
        }

        $this->currentStep++;
    }

    public function backStep()
    {
        $this->currentStep--;
    }

    public function openNewApartment()
    {
        $this->residentStep2->openNewApartment();
    }

    public function closeNewApartment($index)
    {
        $this->residentStep2->closeNewApartment($index);
    }

    public function submit()
    {
        try {
            $url = null;

            if ($this->residentStep1->img_user) {
                $url = $this->residentStep1->img_user->store('imgsUser', 'public');
            }

            $resident = User::create([
                'name' => $this->residentStep1->name,
                'surname' => $this->residentStep1->surname,
                'is_active' => false,
                'is_active_mail' => false,
                'phone_number' => $this->residentStep1->phone_number,
                'img_user' => $url,
                'email' => $this->residentStep1->email,
                'password' =>  $this->residentStep1->password ??= Hash::make('password'),
            ])->assignRole('condomino');

            foreach ($this->residentStep2->newApartment as $apartment) {
                Apartment::create([
                    'name' => $apartment['name_apartment'],
                    'unit_number' => $apartment['unit_number'],
                    'floor' => $apartment['floor'],
                    'square_metres' => $apartment['square_metres'],
                    'rooms' => $apartment['rooms'],
                    'resident_id' => $resident->id,
                ]);
            }

            session()->flash('message', 'Elemento creato con successo!');
            Log::info('Creazione Residente - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            Log::error('Creazione Residente - Errore di creazione');
        }

        return $this->redirect('/admin/residents', navigate: true);
    }

    public function render()
    {
        $apartments = Apartment::where('resident_id', NULL)->paginate(10);
        return view('livewire.admin.residents.create-residents', compact('apartments'));
    }
}
