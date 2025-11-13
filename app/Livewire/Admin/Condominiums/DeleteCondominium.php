<?php

namespace App\Livewire\Admin\Condominiums;

use App\Models\Condominium;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeleteCondominium extends Component
{
    public Condominium $condominium;

    public function mount(Condominium $condominium)
    {
        $this->condominium =  $condominium;
    }

    public function deleteCondominium()
    {
        try {
            if ($this->condominium) {
                $this->condominium->delete();
            }

            Log::info('Eliminazione Condominio - Operazione completata con successo');
            session()->flash('message', 'Elemento eliminato con successo!');
        } catch (\Throwable $th) {
            Log::error('Eliminazione Condominio - Errore di eliminazione');
            session()->flash('message', 'Errore di eliminazione. Riprova.');
        }

        return $this->redirect('/admin/condominiums', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.condominiums.delete-condominium');
    }
}
