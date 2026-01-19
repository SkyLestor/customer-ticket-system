<?php

namespace App\Jobs;

use App\Mail\TicketClosed;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendTicketClosedEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Ticket $ticket)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $ticketCreator = User::where('id', $this->ticket->user_id)->first();
        if ($ticketCreator) {
            Mail::to($ticketCreator)->send(new TicketClosed($this->ticket));
        }
    }
}
