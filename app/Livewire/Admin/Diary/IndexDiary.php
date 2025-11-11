<?php

namespace App\Livewire\Admin\Diary;

use App\Models\Diary;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class IndexDiary extends Component
{
    use WithPagination;

    public $search = '';
    public $dateSearch = '';
    public $filterCategory = '';
    public $filterImportant = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterCategory()
    {
        $this->resetPage();
    }
   
    public function updatedDateSearch()
    {
        $this->resetPage();
    }
    
    public function updatedFilterImportant()
    {
        $this->resetPage();
    }
   
    public function resetFilter()
    {
        $this->search = '';
        $this->dateSearch = '';
        $this->filterCategory = '';
        $this->filterImportant = false;
    }

    public function render()
    {
        $diaries = Diary::query();

        if ($this->search) {
            $diaries = $diaries->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterCategory) {
            $diaries = $diaries->where('category', $this->filterCategory);
        }
        
        if ($this->dateSearch) {
            $diaries = $diaries->where('date', $this->dateSearch);
        }
       
        if ($this->filterImportant) {
            $diaries = $diaries->where('is_important', $this->filterImportant);
        }

        $diaries = $diaries->where('user_id', Auth::id())->orderBy('date', 'desc')->paginate(10);


        $categories = config('Condo.categories');
        return view('livewire.admin.diary.index-diary', compact('diaries', 'categories'));
    }
}
