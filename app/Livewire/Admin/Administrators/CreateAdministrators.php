<?php

namespace App\Livewire\Admin\Administrators;

use App\Livewire\Forms\Administrators\Create\Step1;
use App\Models\Condominium;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAdministrators extends Component
{
    use WithFileUploads;

    public Step1 $administratorsStep1;
    public $selectedCondominiums = [];
    public $currentStep = 1;

    protected $rules = [
        'selectedCondominiums' => 'nullable|array',
        'selectedCondominiums.*' => 'integer|exists:condominiums,id',
    ];

    public function addStep()
    {
        if ($this->currentStep === 1) {
            $this->administratorsStep1->validate();
        } elseif ($this->currentStep === 2) {
            $this->validateOnly('selectedCondominiums');
        }

        $this->currentStep++;
    }

    public function backStep()
    {
        $this->currentStep--;
    }
    public function submit()
    {
        try {
            $url = null;

            if ($this->administratorsStep1->img_user) {
                $url = $this->administratorsStep1->img_user->store('imgsUser', 'public');
            }

            $administrator =  User::create([
                'name' => $this->administratorsStep1->name,
                'surname' => $this->administratorsStep1->surname,
                'phone_number' => $this->administratorsStep1->phone_number,
                'img_user' => $url,
                'email' => $this->administratorsStep1->email,
                'password' =>  $this->administratorsStep1->password ??= Hash::make('password'),
            ])->assignRole('amministratore');

            // Associa i condomìni selezionati
            foreach ($this->selectedCondominiums as $condId) {
                Condominium::where('id', $condId)
                    ->update(['administrator_id' => $administrator->id]);
            }

            session()->flash('message', 'Elemento creato con successo!');
            return $this->redirect('/administrators', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            return $this->redirect('/administrators', navigate: true);
        }
    }

    public function render()
    {
        $condominiums = Condominium::whereNull('administrator_id')->latest()->paginate();

        $selectedCondominiumList = collect();

        if ($this->currentStep === 3 && !empty($this->selectedCondominiums)) {
            $selectedCondominiumList = Condominium::whereIn('id', $this->selectedCondominiums)->get();
        }

        return view('livewire.admin.administrators.create-administrators', compact('condominiums', 'selectedCondominiumList'));
    }
}
