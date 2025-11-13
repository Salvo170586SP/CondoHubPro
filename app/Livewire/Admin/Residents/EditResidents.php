<?php

namespace App\Livewire\Admin\Residents;

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

    protected $rules = [
        'name' => 'required|string',
        'surname' => 'required|string',
        'phone_number' => 'nullable|numeric',
        'img_user' => 'nullable',

        'name_apartment' => 'required|max:30|string',
        'unit_number' => 'nullable|string',
        'floor' => 'required|string',
        'square_metres' => 'required|numeric',
        'rooms' => 'required|numeric',
    ];

    protected $messages = [
        'name.required' => 'il campo è obbligatorio',
        'surname.required' => 'il campo è obbligatorio',
        'phone_number.numeric' => 'il campo deve contenere numeri',

        'name_apartment.required' => 'il campo è obbligatorio',
        'name_apartment.max' => 'il campo deve contenere massimo 30 caratteri',
        'floor.required' => 'il campo è obbligatorio',
        'square_metres.required' => 'il campo è obbligatorio',
        'square_metres.numeric' => 'il campo può contenere solo numeri',
        'rooms.required' => 'il campo è obbligatorio',
        'rooms.numeric' => 'il campo può contenere solo numeri',
    ];

    public function mount(User $resident)
    {
        $this->resident = $resident;
        $this->name = $resident->name;
        $this->surname = $resident->surname;
        $this->phone_number = $resident->phone_number;
        $this->img_user = $resident->img_user;
        $this->name_apartment = $resident->apartment ? $resident->apartment->name : '';
        $this->floor = $resident->apartment ? $resident->apartment->floor : '';
        $this->unit_number = $resident->apartment ? $resident->apartment->unit_number : '';
        $this->rooms = $resident->apartment ? $resident->apartment->rooms : '';
        $this->square_metres = $resident->apartment ? $resident->apartment->square_metres : '';
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


            if ($this->resident->apartment) {
                $this->resident->apartment->update([
                    'name' => $this->name_apartment,
                    'floor' => $this->floor,
                    'unit_number' => $this->unit_number,
                    'rooms' => $this->rooms,
                    'square_metres' => $this->square_metres,
                ]);
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
