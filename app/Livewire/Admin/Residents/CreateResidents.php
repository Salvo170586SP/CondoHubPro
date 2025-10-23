<?php

namespace App\Livewire\Admin\Residents;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateResidents extends Component
{

    use WithFileUploads;

    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;
    public $email = '';
    public $password;
    public $apartment_id;

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


    public function submit()
    {
        try {
            $url = null;

            if ($this->img_user) {
                $url = $this->img_user->store('imgsUser', 'public');
            }

            $resident =  User::create([
                'name' => $this->name,
                'surname' => $this->surname,
                'phone_number' => $this->phone_number,
                'img_user' => $url,
                'email' => $this->email,
                'password' =>  $this->password ??= Hash::make('password'),
            ])->assignRole('condomino');

            $apartment = Apartment::findOrFail($this->apartment_id);
            if ($apartment && $resident->resident_id) {
                $apartment->resident_id = NULL;
            }
            $apartment->resident_id = $resident->id;

            $apartment->save();

            session()->flash('message', 'Elemento creato con successo!');
            return $this->redirect('/admin/residents', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            return $this->redirect('/admin/residents', navigate: true);
        }
    }

    public function render()
    {
        $apartments = Apartment::latest()->paginate(10);
        return view('livewire.admin.residents.create-residents', compact('apartments'));
    }
}
