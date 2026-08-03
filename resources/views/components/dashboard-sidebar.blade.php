<aside class="dashboard-sidebar">
    <!-- Logo / Brand -->
    <div class="flex items-center justify-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            Dashboard
        </h2>
    </div>
    <!-- Navigation Links -->
    <nav class="flex flex-col flex-1 space-y-2">
        
        <!-- 1. List Tickets (Visible to all Dashboard Users) -->
        <a href="{{ route('tickets.index') }}" 
        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white">
            <!-- Heroicon: ticket -->
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
            Tickets
        </a>
        <!-- 2. Register Employee (Visible ONLY to Admins) -->
        @if(auth()->user()->role === \App\Enums\UserRole::E_ADMIN)
            <a href="{{ route('employees.create') }}" 
            class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Register Employee
            </a>

            <a href="{{ route('employees.index') }}" 
            class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                List Employees
            </a>
        @endif
    </nav>
</aside>