<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navigation Bar -->
    <header class="navbar">
        <a href="{{ route('home') }}" class="logo">
            Ticket<span>Tracker</span>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('tickets.create') }}">Create ticket</a></li>
            <li><a href="{{ route('tickets.track') }}">Search ticket</a></li>
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
    <main>
        {{ $slot }}
    </main>
    <footer class="bg-[#0f172a] text-slate-400 pt-16 pb-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bottom Copyright Section -->
            <div class="border-t border-slate-800/80 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} Ticket Tracker Inc. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-slate-400 transition">Privacy</a>
                    <a href="#" class="hover:text-slate-400 transition">Terms</a>
                    <a href="#" class="hover:text-slate-400 transition">Cookies</a>
                </div>
            </div>

        </div>
    </footer>
</body>
</html>