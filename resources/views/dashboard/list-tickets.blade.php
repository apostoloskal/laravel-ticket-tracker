<x-dashboard-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>
    <div class="flex-1 flex flex-col">
        <div class="sm:flex sm:items-center sm:justify-between mb-6">
            <div class="w-full justify-center">
                <h1 class="text-center text-2xl font-bold text-gray-900 dark:text-white">Tickets</h1>
            </div>
        </div>

        <!-- Table Wrapper -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    
                    <!-- Table Headers -->
                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Assigned To
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Customer Email
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Created
                            </th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        @forelse($tickets as $ticket)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                
                                <!-- Title -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $ticket->title }}
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                                        {{ $ticket->category }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                                        {{ $ticket->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
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
                                    </span>
                                </td>

                                <!-- Email -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                    {{ $ticket->email }}
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                    {{ $ticket->created_at->format('M d, Y') }}
                                </td>

                                <!-- Actions (View & Delete) -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-4">
                                        
                                        <!-- View Button -->
                                        <a href="{{ route('tickets.show', $ticket) }}" 
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                                            View
                                        </a>

                                        <!-- Delete Button (Requires a Form) -->
                                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ticket? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Empty State -->
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No tickets found</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">There are currently no support tickets in the system.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-dashboard-layout>