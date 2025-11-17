<?php

namespace App\Livewire\Admin\Administrators;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteAdministrator extends Component
{
    public User $administrator;

    public function mount(User $administrator)
    {
        $this->administrator =  $administrator;
    }

    public function deleteAdministrator()
    {
        try {
            if ($this->administrator) {
                if ($this->administrator->img_user) {
                    Storage::disk('public')->delete($this->administrator->img_user);
                }
                $this->administrator->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            Log::info('Eliminazione Amministratore - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Amministratore - Errore di eliminazione');
        }

        return $this->redirect('/admin/administrators', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.administrators.delete-administrator');
    }
}
