@php use App\Enums\TicketStatus; @endphp
<div class="max-w-4xl mx-auto space-y-6">

    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticket->title }}</h1>
            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
                <span>Created {{ $ticket->created_at->diffForHumans() }}</span>
                •
                <span>By {{ $ticket->user->name }}</span>
            </div>
        </div>

        <div class="flex flex-col items-end gap-4">
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $ticket->status === TicketStatus::OPEN ? 'bg-green-100 text-emerald-500' : 'bg-gray-100 text-gray-800' }}">
                {{ $ticket->status->label() }}
            </span>
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                {{ $ticket->priority->label() }}
            </span>
        </div>
    </div>

    {{-- Description Body --}}
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Description</h3>
        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
            {{ $ticket->description }}
        </div>
    </div>

    {{-- Attachments Section --}}
    @if($ticket->attachments->count() > 0)
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Attachments</h3>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($ticket->attachments as $attachment)
                    <li class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-md">
                        <div class="flex items-center truncate">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                            <span
                                class="text-sm text-gray-600 dark:text-gray-300 truncate">{{ $attachment->file_name }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
