<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Condominium;
use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class IndexFeedbacks extends Component
{
    use WithPagination;

    public Condominium $condominium;
    public $search = '';
    public $filterPriority = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterPriority()
    {
        $this->resetPage();
    }

    public function render()
    {
        $priorities = config('Condo.priorities');

        $feedbacks = Feedback::query();

        if ($this->search) {
            $feedbacks = $feedbacks->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterPriority) {
            $feedbacks = $feedbacks->where('priority', $this->filterPriority);
        }

        $feedbacks = $feedbacks->where('condominium_id', $this->condominium->id)->latest()->paginate(5);

        return view('livewire.admin.feedbacks.index-feedbacks', compact('feedbacks', 'priorities'));
    }
}
