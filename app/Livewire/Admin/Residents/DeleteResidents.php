<?php

namespace App\Livewire\Admin\Residents;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeleteResidents extends Component
{
    public User $resident;

    public function mount(User $resident)
    {
        $this->resident =  $resident;
    }

    public function deleteResident()
    {
        try {
            if ($this->resident) {
                $this->resident->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            Log::info('Eliminazione Residente - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Residente - Errore di eliminazione');
        }

        return $this->redirect('/admin/residents', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.residents.delete-residents');
    }
}
