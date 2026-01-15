<?php

namespace App\Livewire;

use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class TicketList extends Component
{
    public function render(): Factory|\Illuminate\Contracts\View\View|View
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $tickets = Ticket::with('user')
                ->latest()
                ->get();
        } else {
            $tickets = $user->tickets()
                ->latest()
                ->get();
        }

        return view('livewire.ticket-list', [
            'tickets' => $tickets,
        ]);
    }
}
