<x-mail::message>
# New Ticket Created

**User:** {{ $ticket->user->name }} <br>
**Title:** {{ $ticket->title }} <br>
**Priority:** {{ $ticket->priority->label() }} <br>

<x-mail::button :url="route('ticket.show', $ticket)">
View Ticket
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
