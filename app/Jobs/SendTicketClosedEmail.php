<?php

namespace App\Jobs;

use App\Mail\TicketClosed;
use App\Models\Ticket;
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
        $user = $this->ticket->user;
        if ($user) {
            Mail::to($user)->send(new TicketClosed($this->ticket));
        }
    }
}
