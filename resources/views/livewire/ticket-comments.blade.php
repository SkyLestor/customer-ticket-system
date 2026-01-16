<div class="space-y-6">
    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Discussion</h3>

    {{-- Comment Form --}}
    <form wire:submit="postComment" class="relative">
        <textarea
            wire:model="content"
            rows="3"
            class="p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white sm:text-sm"
            placeholder="Add a comment..."

        ></textarea>

        <div class="absolute bottom-2 right-2">
            <button
                type="submit"
                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Post Reply
            </button>
        </div>
        @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </form>

    {{-- Comments List --}}
    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="flex space-x-3">
                <div class="shrink-0">
                    <div
                        class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xs">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                </div>
                <div class="grow">
                    <div class="text-sm">
                        <span class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                        <span
                            class="text-gray-500 dark:text-gray-400 text-xs ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="mt-1 text-sm text-gray-700 dark:text-gray-300">
                        {{ $comment->content }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
