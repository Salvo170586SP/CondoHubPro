<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateFeedbacks extends Component
{
    public Condominium $condominium;
    public $title = '';
    public $description = '';
    public $priority = null;

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
            Feedback::create([
                'condominium_id' => $this->condominium->id,
                'created_by' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'priority' => $this->priority
            ]);

            session()->flash('message', 'Elemento creato con successo!');
            Log::info('Creazione Segnalazione - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('error', 'Errore di creazione. Riprova.');
            Log::error('Creazione Segnalazione - Errore di creazione');
        }

        $condominium_id = $this->condominium->id;
        return $this->redirect("/admin/condominiums/$condominium_id/feedbacks", navigate: true);
    }

    public function render()
    {
        $priorities = config('Condo.priorities');
        return view('livewire.admin.feedbacks.create-feedbacks', compact('priorities'));
    }
}
