<!-- Navigation Bar -->
<header class="navbar">
    <a href="{{ route('home') }}" class="logo">
        Ticket<span>Tracker</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('tickets.create') }}">Create ticket</a></li>
        <li><a href="{{ route('tickets.track') }}">Search ticket</a></li>
        @auth
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        @endauth
    </ul>
    @auth
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-slate-300">
                Hello, {{ auth()->user()->username }}!
            </span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm font-medium text-red-600 transition-colors duration-200 rounded-lg hover:bg-red-50 dark:text-red-400 dark:hover:bg-gray-800">
                    <!-- Heroicon: logout -->
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    @endauth
    @guest
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn btn-login">Log In</a>
        </div>
    @endguest
</header>