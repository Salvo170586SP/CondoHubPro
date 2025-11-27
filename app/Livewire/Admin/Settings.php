<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $is_active = false;
    public $is_active_mail = false;

    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;
    public $password = '';

    public $change_password = false;
    public $is_edit = false;

    protected function rules()
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'password' => $this->change_password ? 'required|min:8' : 'nullable',
            'img_user' => 'nullable',
        ];
    }


    protected $messages = [
        'name.required' => 'il campo è obbligatorio',
        'surname.required' => 'il campo è obbligatorio',
        'password.required' => 'il campo è obbligatorio',
    ];

    public function mount()
    {
        $user = auth()->user();
        $this->is_active = $user->is_active;
        $this->is_active_mail = $user->is_active_mail;

        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->phone_number = $user->phone_number;
        $this->img_user = $user->img_user;
    }

    public function submit()
    {

        $this->validate();
        
        try {
            $user = auth()->user();

            // cambio img
            $url = $user->img_user;
            if ($this->img_user instanceof TemporaryUploadedFile) {
                if ($user->img_user  && Storage::disk('public')->exists($user->img_user)) {
                    Storage::disk('public')->delete($user->img_user);
                }
                $url = $this->img_user->store('ImgsUser', 'public');
            }

            // Aggiungi password solo se deve essere cambiata
            if ($this->change_password && !empty($this->password)) {
                $this->password = $this->password;
            }

            $user->update([
                'name' => $this->name,
                'surname' => $this->surname,
                'phone_number' => $this->phone_number,
                'img_user' => $url,
                'password' => $this->password,
            ]);

            // Reset del campo password
            $this->password = '';
            $this->change_password = false;

            $this->toggleEdit();

            Log::info('Modifica User - Elemento modificato con successo');
            session()->flash('message', 'Elemento modificato con successo!');
        } catch (\Throwable $th) {
            Log::error('Modifica User - Errore di modifica');
            session()->flash('error', 'Errore di modifica. Riprova.');
        }

        return $this->redirect('/admin/settings', navigate: true);
    }

    public function updatedIsActive()
    {
        $user = auth()->user();

        if ($this->is_active) {
            $isActive =  true;
        } else {
            $isActive =  false;
        }

        $user->update([
            'is_active' => $isActive,
        ]);

        $this->dispatch('activeNotifications');
    }

    public function updatedIsActiveMail()
    {
        $user = auth()->user();

        if ($this->is_active_mail) {
            $isActiveMail =  true;
        } else {
            $isActiveMail =  false;
        }

        $user->update([
            'is_active_mail' => $isActiveMail,
        ]);
    }

    public function toggleEdit()
    {
        $this->is_edit = !$this->is_edit;
    }

    public function updatedChangePassword()
    {
        $this->change_password;
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
