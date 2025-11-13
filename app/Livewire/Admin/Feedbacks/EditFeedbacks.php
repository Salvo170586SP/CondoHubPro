<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EditFeedbacks extends Component
{
    public Condominium $condominium;
    public Feedback $feedback;
    public $title;
    public $description;
    public $priority;


    public function mount(Feedback $feedback)
    {
        $this->feedback = $feedback;
        $this->title = $feedback->title;
        $this->description = $feedback->description;
        $this->priority = $feedback->priority;
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required|max:50|string',
            'description' => 'required|string',
            'priority' => 'required',
        ], [
            'title.required' => 'il campo è obbligatorio',
            'title.max' => 'max 50 caratteri',
            'description.required' => 'il campo è obbligatorio',
            'priority.required' => 'il campo è obbligatorio',
        ]);

        try {
            $this->feedback->update([
                'title' => $this->title,
                'description' => $this->description,
                'priority' => $this->priority
            ]);

            session()->flash('messageFeedback', 'Elemento modificato con successo!');
            Log::info('Modifica Segnalazione - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('errorFeedback', 'Errore di modifica. Riprova.');
            Log::error('Modifica Segnalazione - Errore di modifica'); 
        }
        
        $condominium_id = $this->condominium->id;
        return $this->redirect("/admin/condominiums/$condominium_id/feedbacks", navigate: true);
    }

    public function render()
    {
        $priorities = config('Condo.priorities');
        return view('livewire.admin.feedbacks.edit-feedbacks', compact('priorities'));
    }
}
