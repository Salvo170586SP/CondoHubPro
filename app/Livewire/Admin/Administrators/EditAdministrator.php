<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAdministrator extends Component
{
    use WithFileUploads;

    public User $administrator;
    public $name = '';
    public $surname = '';
    public $phone_number = '';
    public $img_user = null;
    protected static ?string $password;

    public function mount(User $administrator)
    {
        $this->administrator = $administrator;
        $this->name = $administrator->name;
        $this->surname = $administrator->surname;
        $this->phone_number = $administrator->phone_number;
        $this->img_user = $administrator->img_user;
    }

    public function editAdministrator()
    {
        $this->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone_number' => 'nullable|numeric',
            'img_user' => 'nullable',
        ], [
            'name.required' => 'il campo è obbligatorio',
            'surname.required' => 'il campo è obbligatorio',
            'phone_number.numeric' => 'il campo deve contenere numeri',
        ]);

        try {
            $url = $this->administrator->img_user;

            // Se è stata caricata una nuova immagine
            if ($this->img_user && !is_string($this->img_user)) {
                // Se esiste già un'immagine, la eliminiamo
                if ($this->administrator->img_user) {
                    // Elimina il file fisico
                    Storage::disk('public')->delete($this->administrator->img_user);
                }

                $url = $this->img_user->store('imgsUser', 'public');
            }

            $this->administrator->update([
                'name' => $this->name,
                'surname' => $this->surname,
                'phone_number' => $this->phone_number,
                'img_user' => $url,
            ]);

            session()->flash('message', 'Elemento modificato con successo!');
            return $this->redirect('/administrators', navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore nella modifica. Riprova.');
            return $this->redirect('/administrators', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.administrators.edit-administrator');
    }
}
