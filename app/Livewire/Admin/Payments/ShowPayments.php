<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Payment;
use Livewire\Component;

class ShowPayments extends Component
{
    public Payment $payment;
  
    public function render()
    {
        return view('livewire.admin.payments.show-payments');
    }
}
