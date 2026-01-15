<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTicketList extends Component
{
    use WithPagination;

    public $search = '';

    public $status = ''; // Empty = All
    public $priority = ''; // Empty = All

    // Reset pagination when searching
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function updatedPriority(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Ticket::with('user')->latest();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }
        if ($this->priority) {
            $query->where('priority', $this->priority);
        }

        return view('livewire.admin-ticket-list', [
            'tickets' => $query->paginate(10),
        ]);
    }
}
