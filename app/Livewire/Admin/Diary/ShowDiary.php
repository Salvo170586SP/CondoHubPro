<?php

namespace App\Livewire\Admin\Diary;

use App\Models\Diary;
use Livewire\Component;

class ShowDiary extends Component
{
    public Diary $diary;

    public function render()
    {
        $categories = config('Condo.categories');
        return view('livewire.admin.diary.show-diary', compact('categories'));
    }
}
