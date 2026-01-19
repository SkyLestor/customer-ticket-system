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

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($ticket->attachments as $attachment)
                    @if($attachment->is_image)
                        {{-- Image Preview --}}
                        <div
                            class="group relative aspect-video bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-600">
                            <img src="{{ $attachment->url }}" alt="{{ $attachment->file_name }}"
                                 class="object-cover w-full h-full">

                            {{-- Hover Overlay to Download --}}
                            <a href="{{ $attachment->url }}" target="_blank"
                               class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>
                        </div>
                    @else
                        {{-- File Download Card --}}
                        <a href="{{ $attachment->url }}"
                           class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <div class="ml-3 overflow-hidden">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $attachment->file_name }}</p>
                                <p class="text-xs text-gray-500">Download</p>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
        <livewire:ticket-comments :ticket="$ticket"/>
    </div>

</div>
