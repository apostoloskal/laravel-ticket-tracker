<x-layout>
    <x-slot:title>
        Ticket Details
    </x-slot:title>
    

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Header Section -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <div class="flex items-center space-x-3">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">
                        {{ $ticket->title }}
                    </h2>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                        #{{ $ticket->tracking_code }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            
            <!-- Main Content: Description -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                            Ticket Description
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 text-gray-700 dark:text-gray-300 break-words">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar: Metadata -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                            Ticket Details
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="space-y-4">
                            
                            <!-- Status -->
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold capitalize">
                                    {{ $ticket->status->value }}
                                </dd>
                            </div>

                            <!-- Category -->
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white capitalize">
                                    {{ $ticket->category->value }}
                                </dd>
                            </div>

                            <!-- Assignee -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Assigned Agent</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                    @if($ticket->assignedEmployee)
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium">{{ $ticket->assignedEmployee->display_name }}</span>
                                            @if($ticket->assignedEmployee->job_title)
                                                <span class="text-xs text-gray-500">({{ $ticket->assignedEmployee->job_title }})</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">Unassigned</span>
                                    @endif
                                </dd>
                            </div>

                        </dl>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    Comments
                </h3>
            </div>
            <div class="p-6">
                <!-- Add Comment Form -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <form action="{{ route('tickets.comment', $ticket) }}" method="POST">
                        @csrf
                        <div>
                            <label for="content" class="sr-only">Add your comment</label>
                            <textarea 
                                id="content" 
                                name="content" 
                                rows="4" 
                                required
                                class="w-full rounded-lg px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-900 border @error('content') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 @enderror shadow-sm focus:outline-none focus:ring-2 transition-colors duration-200"
                                placeholder="Add your comment or update..."
                            ></textarea>
                            @error('content')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-3 flex items-center justify-end">
                            <button 
                                type="submit" 
                                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                            >
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Comment Thread -->
                <div class="space-y-8 mb-8">
                    @forelse($ticket->comments as $comment)
                        <div class="flex space-x-3">
                            <!-- Avatar Placeholder -->
                            <div class="flex-shrink-0">
                                @if($comment->employee_profile_id)
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                        <span class="text-indigo-800 dark:text-indigo-200 font-medium text-sm">
                                            {{ strtoupper(substr($comment->employeeProfile->display_name ?? 'A', 0, 1)) }}
                                        </span>
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-600 dark:text-gray-300 font-medium text-sm">C</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Comment Content -->
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    @if($comment->employee_profile_id)
                                        {{ $comment->employeeProfile->display_name ?? 'Agent' }}
                                        <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            Staff
                                        </span>
                                    @else
                                        Customer
                                    @endif
                                </div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $comment->created_at->diffForHumans() }}
                                </div>
                                <div class="mt-2 text-sm text-gray-700 dark:text-gray-300 break-words">
                                    {!! nl2br(e($comment->content)) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-sm italic">No comments yet. Be the first to reply!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout>