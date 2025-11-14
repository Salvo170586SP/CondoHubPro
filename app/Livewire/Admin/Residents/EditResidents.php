<?php

namespace App\Livewire\Admin\Residents;

use App\Models\Apartment;
use App\Models\User;
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
    public $name_apartment = '';
    public $floor;
    public $unit_number;
    public $rooms;
    public $square_metres;
    public $newApartment = [];

    protected $rules = [
        'name' => 'required|string',
        'surname' => 'required|string',
        'phone_number' => 'nullable|numeric',
        'img_user' => 'nullable',

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

        'newApartment.*.name_apartment.required' => 'il campo è obbligatorio',
        'newApartment.*.name_apartment.max' => 'il campo deve contenere massimo 30 caratteri',
        'newApartment.*.floor.required' => 'il campo è obbligatorio',
        'newApartment.*.square_metres.required' => 'il campo è obbligatorio',
        'newApartment.*.square_metres.numeric' => 'il campo può contenere solo numeri',
        'newApartment.*.rooms.required' => 'il campo è obbligatorio',
        'newApartment.*.rooms.numeric' => 'il campo può contenere solo numeri',
    ];

    public function mount(User $resident)
    {
        $this->resident = $resident;
        $this->name = $resident->name;
        $this->surname = $resident->surname;
        $this->phone_number = $resident->phone_number;
        $this->img_user = $resident->img_user;

        foreach ($resident->apartments as $index => $apartment) {
            $this->newApartment[$index] = [
                'id' => $apartment->id,
                'name_apartment' => $apartment->name,
                'floor' => $apartment->floor,
                'unit_number' => $apartment->unit_number,
                'rooms' => $apartment->rooms,
                'square_metres' => $apartment->square_metres,
            ];
        }
    }

    public function addApartment()
    {
        $this->newApartment[] = [
            'id' => null,
            'name_apartment' => '',
            'floor' => '',
            'unit_number' => '',
            'rooms' => '',
            'square_metres' => '',
        ];
    }

    public function closeNewApartment($index)
    {
        // Se l'appartamento ha un ID, significa che esiste nel DB
        if (isset($this->newApartment[$index]['id']) && $this->newApartment[$index]['id']) {
            $apartment = Apartment::find($this->newApartment[$index]['id']);
            if ($apartment) {
                $apartment->delete();
            }
        }

        unset($this->newApartment[$index]);
        $this->newApartment = array_values($this->newApartment);
    }

    public function deleteApartment($index, $apartment_id)
    {
        $apartment = Apartment::findOrFail($apartment_id);
        if ($apartment) {
            $apartment->delete();
        }

        unset($this->newApartment[$index]);
        $this->newApartment = array_values($this->newApartment);
    }


    public function submit()
    {
        $this->validate();

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

            // Gestione appartamenti
            foreach ($this->newApartment as $apartmentData) {
                if (isset($apartmentData['id']) && $apartmentData['id']) {
                    // Aggiorna appartamento esistente
                    $apartment = Apartment::find($apartmentData['id']);
                    if ($apartment) {
                        $apartment->update([
                            'name' => $apartmentData['name_apartment'],
                            'floor' => $apartmentData['floor'],
                            'unit_number' => $apartmentData['unit_number'],
                            'rooms' => $apartmentData['rooms'],
                            'square_metres' => $apartmentData['square_metres'],
                        ]);
                    }
                } else {
                    // Crea nuovo appartamento
                    Apartment::create([
                        'name' => $apartmentData['name_apartment'],
                        'resident_id' => $this->resident->id,
                        'floor' => $apartmentData['floor'],
                        'unit_number' => $apartmentData['unit_number'],
                        'rooms' => $apartmentData['rooms'],
                        'square_metres' => $apartmentData['square_metres'],
                    ]);
                }
            }

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
        return view('livewire.admin.residents.edit-residents');
    }
}
