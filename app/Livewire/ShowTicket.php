<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class ShowTicket extends Component
{
    public Ticket $ticket;

    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        return view('livewire.show-ticket');
    }
}
