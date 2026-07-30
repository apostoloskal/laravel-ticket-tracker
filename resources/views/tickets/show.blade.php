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
                    <div class="px-4 py-5 sm:p-6 text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
                        {{ $ticket->description }}
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
    </div>
</x-layout>