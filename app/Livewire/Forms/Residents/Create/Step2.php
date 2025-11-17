<?php

namespace App\Livewire\Forms\Residents\Create;

use App\Models\Apartment;
use Livewire\Form;

class Step2 extends Form
{
    public $name_apartment = '';
    public $unit_number = '';
    public $floor = '';
    public $square_metres;
    public $rooms;
    public $newApartment = [];

    protected $rules = [
        'newApartment.*.name_apartment' => 'required|max:30|string',
        'newApartment.*.unit_number' => 'nullable|string',
        'newApartment.*.floor' => 'required|string',
        'newApartment.*.square_metres' => 'required|numeric',
        'newApartment.*.rooms' => 'required|numeric',
    ];

    protected $messages = [
        'newApartment.*.name_apartment.required' => 'il campo è obbligatorio',
        'newApartment.*.name_apartment.max' => 'il campo deve contenere massimo 30 caratteri',
        'newApartment.*.floor.required' => 'il campo è obbligatorio',
        'newApartment.*.square_metres.required' => 'il campo è obbligatorio',
        'newApartment.*.square_metres.numeric' => 'il campo può contenere solo numeri',
        'newApartment.*.rooms.required' => 'il campo è obbligatorio',
        'newApartment.*.rooms.numeric' => 'il campo può contenere solo numeri',
    ];

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
}
