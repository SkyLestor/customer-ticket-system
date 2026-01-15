<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        return view('ticket.create');
    }

    public function show(Ticket $ticket)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $ticket->user_id) {
            abort(403);
        }
        return view('ticket.show', compact('ticket'));
    }

}
