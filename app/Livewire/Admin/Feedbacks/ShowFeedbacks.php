<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
use Livewire\Component;

class ShowFeedbacks extends Component
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

    public function render()
    {
        $priorities = config('Condo.priorities');
        return view('livewire.admin.feedbacks.show-feedbacks', compact('priorities'));
    }
}
