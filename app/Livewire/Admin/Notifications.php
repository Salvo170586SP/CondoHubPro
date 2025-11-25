<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public $unreadCount;
    public $userId;

    public function mount()
    {
        $this->refreshNotifications();
        $this->userId = Auth::id();
    }

    #[On('echo-private:App.Models.User.{userId},.Illuminate\Notifications\Events\BroadcastNotificationCreated')]
    public function handleNotification($payload)
    {
        $this->refreshNotifications();
    }


    #[On('notification-deleted')]
    #[On('all-notifications-deleted')]
    #[On('notification-received')]
    public function refreshNotifications()
    {
        $user = Auth::user();
        $this->notifications = $user->notifications;
        $this->unreadCount = $user->unreadNotifications->count();
    }
    
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->unreadCount = 0;
    }
    
    public function destroy($notificationId)
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->delete();
        $this->dispatch('notification-deleted');
        $this->refreshNotifications();
    }
    
    public function destroyAll()
    {
        Auth::user()->notifications()->delete();
        $this->dispatch('all-notifications-deleted');
        $this->refreshNotifications();
    }
    
    #[On('activeNotifications')]
    public function render()
    {
        return view('livewire.admin.notifications');
    }
}
