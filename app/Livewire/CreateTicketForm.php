<?php

namespace App\Livewire;

use App\Enums\TicketStatus;
use App\Jobs\SendTicketCreatedEmail;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;

class CreateTicketForm extends Component
{
    use WithFileUploads;

    public $title = '';

    public $description = '';

    public $priority = 'low';

    public $attachment;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:10',
        'priority' => 'required',
        'attachment' => 'nullable|file|max:10240',
    ];

    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $ticket = Auth::user()->tickets()->create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => TicketStatus::OPEN,
        ]);

        if ($this->attachment) {
            $ticket->attachments()->create([
                'file_path' => $this->attachment->store('attachments'),
                'file_name' => $this->attachment->getClientOriginalName(),
            ]);
        }

        SendTicketCreatedEmail::dispatch($ticket);

        return redirect()->route('dashboard');
    }

    public function render(): Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.create-ticket-form');
    }
}
