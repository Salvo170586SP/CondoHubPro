<?php

namespace App\Livewire\Admin\Diary;

use App\Models\Diary;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EditDiary extends Component
{
    public Diary $diary;
    public $date;
    public $title = '';
    public $content = '';
    public $category;
    public $is_important = false;

    public function mount(Diary $diary)
    {
        $this->diary = $diary;
        $this->date = $diary->date->format('Y-m-d');
        $this->title = $diary->title;
        $this->content = $diary->content;
        $this->category = $diary->category;
        $this->is_important = (bool) $diary->is_important;
    }

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
            $this->diary->update([
                'date' => $this->date,
                'title' => $this->title,
                'content' => $this->content,
                'category' => $this->category,
                'is_important' => $this->is_important,
            ]);

            session()->flash('message', 'Elemento modificato con successo!');
            Log::info('Modifica Agenda - Operazione completata con successo');
        } catch (\Throwable $th) {
            session()->flash('message', 'Errore di modifica. Riprova.');
            Log::error('Modifica Agenda - Errore di modifica');
        }

        return $this->redirect('/admin/diary', navigate: true);
    }


    public function render()
    {
        $categories = config('Condo.categories');
        return view('livewire.admin.diary.edit-diary', compact('categories'));
    }
}
