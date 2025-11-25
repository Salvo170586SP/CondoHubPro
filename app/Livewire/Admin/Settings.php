<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Settings extends Component
{
    public $is_active = false;
    public $img_url = null;

    public function mount()
    {
        $user = auth()->user();
        $this->is_active = $user->is_active;
    }

    public function updatedIsActive()
    {
        $user = auth()->user();

        if ($this->is_active) {
            $isActive =  true;
        } else {
            $isActive =  false;
        }

        $user->update([
            'is_active' => $isActive
        ]);

        $this->dispatch('activeNotifications');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
