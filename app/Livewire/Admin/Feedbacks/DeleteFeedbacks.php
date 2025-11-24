<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeleteFeedbacks extends Component
{
    public Condominium $condominium;
    public Feedback $feedback;

    public function mount(Feedback $feedback)
    {
        $this->feedback =  $feedback;
    }

    public function deleteFeedback()
    {
        try {
            if ($this->feedback) {
                $this->feedback->delete();
            }

            session()->flash('message', 'Elemento eliminato con successo!');
            Log::info('Eliminazione Segnalazione - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di eliminazione. Riprova.');
            Log::error('Eliminazione Segnalazione - Errore di eliminazione');
        }

        $condominium_id = $this->condominium->id;
        return $this->redirect("/admin/condominiums/$condominium_id/feedbacks", navigate: true);
    }
    public function render()
    {
        return view('livewire.admin.feedbacks.delete-feedbacks');
    }
}
