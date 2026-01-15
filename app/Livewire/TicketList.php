<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TicketList extends Component
{
    use WithPagination;

    public function render()
    {
        $tickets = Auth::user()->tickets()
            ->latest()
            ->paginate(10);

        return view('livewire.ticket-list', [
            'tickets' => $tickets,
        ]);
    }
}
