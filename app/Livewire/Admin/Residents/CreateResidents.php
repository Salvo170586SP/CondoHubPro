<?php

namespace App\Livewire\Admin\Residents;

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

    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;
    public $email = '';
    public $password;

    public $name_apartment = '';
    public $unit_number = '';
    public $floor = '';
    public $square_metres;
    public $rooms;
    public $newApartment = [];

    public function openNewApartment()
    {
        $this->newApartment[] = [
            'name_apartment' => '',
            'unit_number' => '',
            'floor' => '',
            'square_metres' => '',
            'rooms' => '',
        ];
    }

    public function closeNewApartment($index)
    {
        unset($this->newApartment[$index]);
        $this->newApartment = array_values($this->newApartment);
    }

    protected $rules = [
        'name' => 'required|string',
        'surname' => 'required|string',
        'phone_number' => 'nullable|numeric',
        'img_user' => 'nullable',
        'email' => 'required|unique:users,email',

        'newApartment.*.name_apartment' => 'required|max:30|string',
        'newApartment.*.unit_number' => 'nullable|string',
        'newApartment.*.floor' => 'required|string',
        'newApartment.*.square_metres' => 'required|numeric',
        'newApartment.*.rooms' => 'required|numeric',
    ];

    protected $messages = [
        'name.required' => 'il campo è obbligatorio',
        'surname.required' => 'il campo è obbligatorio',
        'phone_number.numeric' => 'il campo deve contenere numeri',
        'email.required' => 'il campo è obbligatorio',
        'email.unique' => 'Questa mail è esistente',

        'newApartment.*.name_apartment.required' => 'il campo è obbligatorio',
        'newApartment.*.name_apartment.max' => 'il campo deve contenere massimo 30 caratteri',
        'newApartment.*.floor.required' => 'il campo è obbligatorio',
        'newApartment.*.square_metres.required' => 'il campo è obbligatorio',
        'newApartment.*.square_metres.numeric' => 'il campo può contenere solo numeri',
        'newApartment.*.rooms.required' => 'il campo è obbligatorio',
        'newApartment.*.rooms.numeric' => 'il campo può contenere solo numeri',
    ];

    public function submit()
    {
        $this->validate();

        try {
            $url = null;

            if ($this->img_user) {
                $url = $this->img_user->store('imgsUser', 'public');
            }

            $resident = User::create([
                'name' => $this->name,
                'surname' => $this->surname,
                'phone_number' => $this->phone_number,
                'img_user' => $url,
                'email' => $this->email,
                'password' =>  $this->password ??= Hash::make('password'),
            ])->assignRole('condomino');

            foreach ($this->newApartment as $apartment) {
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
