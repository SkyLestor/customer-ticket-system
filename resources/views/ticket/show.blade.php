<x-layouts::app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket #') . $ticket->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:show-ticket :ticket="$ticket"/>
    </div>
</x-layouts::app>
