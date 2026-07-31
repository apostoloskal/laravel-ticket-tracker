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
                <button type="submit" class="btn btn-login cursor-pointer">
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