<?php

namespace App\Livewire\Forms\Administrators\Create;

use Livewire\Attributes\Validate;
use Livewire\Form;

class Step1 extends Form
{
    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;
    public $email = '';
    public $password;

    protected $rules = [
        'name' => 'required|string',
        'surname' => 'required|string',
        'phone_number' => 'nullable|numeric',
        'img_user' => 'nullable',
        'email' => 'required|unique:users,email',
    ];

    protected $messages = [
        'name.required' => 'il campo è obbligatorio',
        'surname.required' => 'il campo è obbligatorio',
        'phone_number.numeric' => 'il campo deve contenere numeri',
        'email.required' => 'il campo è obbligatorio',
        'email.unique' => 'Questa mail è esistente',
    ];
}
