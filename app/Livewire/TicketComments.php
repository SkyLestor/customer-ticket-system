<?php

namespace App\Livewire;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TicketComments extends Component
{
    public Ticket $ticket;
    public $content = '';

    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function postComment(): void
    {
        $this->validate([
            'content' => 'required|min:2|max:1000',
        ]);

        $this->ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->content,
        ]);

        $this->content = '';
    }

    public function render()
    {
        return view('livewire.ticket-comments', [
            'comments' => $this->ticket->comments()->with('user')->latest()->get()
        ]);
    }
}
