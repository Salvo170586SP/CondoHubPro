<?php

namespace App\Livewire\Admin\Diary;

use App\Models\Diary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateDiary extends Component
{
    public $date;
    public $title = '';
    public $content = '';
    public $category;
    public $is_important = false;

    public function createNote()
    {
        $this->validate([
            'title' => 'required|max:20|string',
            'content' => 'required|min:5|max:255|string',
            'date' => 'required'
        ], [
            'date.required' => 'il campo è obbligatorio',
            'title.required' => 'il campo è obbligatorio',
            'title.max' => 'max 20 caratteri',
            'content.required' => 'il campo è obbligatorio',
            'content.max' => 'max 255 caratteri',
            'content.min' => 'min 5 caratteri',
        ]);

        try {
            Diary::create([
                'user_id' => Auth::id(),
                'date' => $this->date,
                'title' => $this->title,
                'content' => $this->content,
                'category' => $this->category,
                'is_important' => $this->is_important,
            ]);

            session()->flash('message', 'Elemento creato con successo!');
            Log::info('Creazione Agenda - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di creazione. Riprova.');
            Log::error('Creazione Agenda - Errore di creazione');
        }

        return $this->redirect('/admin/diary', navigate: true);
    }


    public function render()
    {
        $categories = config('Condo.categories');
        return view('livewire.admin.diary.create-diary', compact('categories'));
    }
}
