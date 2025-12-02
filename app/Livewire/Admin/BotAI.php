<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;


class BotAI extends Component
{
    public $messages = [];
    public $content = '';
    public $input = '';
    public $pageContext = '';

    public function updatePageContext($context)
    {
        $this->pageContext = $context;
    }

    public function sendMessage()
    {
        if (empty(trim($this->input))) {
            return;
        }

        $userMessage = $this->input;
        $this->input = '';

        $this->messages[] = [
            'role' => 'user',
            'content' => $userMessage
        ];
    }

    public function addBotMessage($message)
    {
        $this->messages[] = [
            'role' => 'assistant',
            'content' => $message
        ];
    }

    public function addErrorMessage($error)
    {
        $this->messages[] = [
            'role' => 'assistant',
            'content' => 'Errore: ' . $error
        ];
    }

    public function render()
    {
        return view('livewire.admin.bot-a-i');
    }
}
