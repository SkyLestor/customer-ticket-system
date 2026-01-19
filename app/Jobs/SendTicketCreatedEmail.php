<?php

namespace App\Jobs;

use App\Mail\TicketCreated;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendTicketCreatedEmail implements ShouldQueue
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
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Mail::to($admin)->send(new TicketCreated($this->ticket));
        }
    }
}
