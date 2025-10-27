<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
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
            
            $condominium_id = $this->condominium->id;
            session()->flash('message', 'Elemento eliminato con successo!');
            return $this->redirect("/admin/condominiums/$condominium_id/feedbacks", navigate: true);
        } catch (\Throwable $th) {
            $condominium_id = $this->condominium->id;
            session()->flash('message', 'Errore di eliminazione. Riprova.');
            return $this->redirect("/admin/condominiums/$condominium_id/feedbacks", navigate: true);
        }
    }
    public function render()
    {
        return view('livewire.admin.feedbacks.delete-feedbacks');
    }
}
