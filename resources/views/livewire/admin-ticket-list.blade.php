@php use App\Enums\TicketPriority;use App\Enums\TicketStatus; @endphp
<div class="space-y-6">

    {{-- Toolbar: Search & Filter --}}
    <div class="flex flex-col sm:flex-row justify-between gap-4">
        {{-- Search Input --}}
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white dark:bg-gray-900 dark:text-white dark:border-gray-700 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Search tickets..."
            />
        </div>

        <div class="flex gap-2">

            {{-- Priority Filter --}}
            <select
                wire:model.live="priority"
                class="block w-full sm:w-48 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-900 dark:text-white dark:border-gray-700"
            >
                <option value="">All Priorities</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">Critical</option>
            </select>

            {{-- Status Filter --}}
            <select
                wire:model.live="status"
                class="block w-full sm:w-48 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-900 dark:text-white dark:border-gray-700"
            >
                <option value="">All Statuses</option>
                <option value="{{ TicketStatus::OPEN }}">Open</option>
                <option value="{{ TicketStatus::CLOSED }}">Closed</option>
            </select>

        </div>
    </div>

    {{-- Data Table --}}
    <div
        class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Title
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    User
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Priority
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Date
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($tickets as $ticket)
                <tr
                    wire:click="showTicket('{{ route('ticket.show', $ticket) }}')"
                    class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                    {{-- Title --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $ticket->title }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ Str::limit($ticket->description, 40) }}
                        </div>
                    </td>

                    {{-- User --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="shrink-0 h-8 w-8">
                                <div
                                    class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-bold text-xs">
                                    {{ substr($ticket->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $ticket->user->name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $ticket->user->email }}
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $ticket->status === TicketStatus::OPEN ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ $ticket->status->label() }}
                            </span>
                    </td>

                    {{-- Priority --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                             <span
                                 class="{{ $ticket->priority === TicketPriority::HIGH ? 'text-red-600 font-bold' : '' }}">
                                {{ $ticket->priority->label() }}
                            </span>
                    </td>

                    {{-- Date --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $ticket->created_at->format('M d, Y') }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button wire:click.stop="toggleStatus('{{ $ticket->uuid }}')"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                            {{ $ticket->status === TicketStatus::OPEN ? 'Close' : 'Reopen' }}
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        No tickets found matching your criteria.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</div>
