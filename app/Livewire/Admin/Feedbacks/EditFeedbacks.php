<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
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

            $condominium_id = $this->condominium->id;
            session()->flash('messageFeedback', 'Elemento modificato con successo!');
            return $this->redirect("/admin/condominiums/$condominium_id/feedbacks", navigate: true);
        } catch (\Throwable $th) {
            $condominium_id = $this->condominium->id;
            session()->flash('errorFeedback', 'Errore di modifica. Riprova.');
            return $this->redirect("/admin/condominiums/$condominium_id/feedbacks", navigate: true);
        }
    }

    public function render()
    {
        $priorities = config('Condo.priorities');
        return view('livewire.admin.feedbacks.edit-feedbacks', compact('priorities'));
    }
}
