<x-layouts::app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 1. Create Ticket Form (Only for Regular Users) --}}
            @if(!auth()->user()->isAdmin())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Create New Ticket</h3>
                    <livewire:create-ticket-form/>
                </div>
            @endif

            {{-- 2. Ticket List (For Everyone - logic handles what they see) --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <livewire:ticket-list/>
            </div>

        </div>
    </div>
</x-layouts::app>
