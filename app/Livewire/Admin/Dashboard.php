<?php

namespace App\Livewire\Admin;

use App\Models\NoticeBoard;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();

        if ($user->hasRole('condomino')) {
            $apartments = $user->apartments;
            // Prendi tutti i condomini associati agli appartamenti
            $condominiumIds = $apartments->pluck('condominium_id')->unique();

            // Prendi gli avvisi SOLO dei condomini a cui appartiene
            $noticeBoards = NoticeBoard::whereIn('condominium_id', $condominiumIds)
                ->latest()
                ->get();
        } else if ($user->hasRole('amministratore')) {
            $condominiums = $user->condominiums;
            $condominiumIds = $condominiums->pluck('id')->unique();
            $noticeBoards = NoticeBoard::whereIn('condominium_id', $condominiumIds)->latest()
                ->get();
        } else {
            $noticeBoards = NoticeBoard::latest()->get();
        }

        $residents = User::role('condomino')->latest()->get();
        $administrators = User::role('amministratore')->latest()->get();
        $types = config('Condo.types');

        return view('livewire.admin.dashboard', compact('residents', 'administrators', 'noticeBoards', 'types'));
    }
}
