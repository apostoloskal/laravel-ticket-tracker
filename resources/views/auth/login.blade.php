<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>
    <div class="min-h-[calc(100vh-74px)] flex items-center justify-center px-4 py-12 bg-slate-50">
        <div class="card">
            <div class="card-header">
                <h2>Login</h2>
            </div>
            <form method="post" action={{ route('login-post') }} class="space-y-6">
                <div>
                    <label for="username" class="label">Username</label>
                    <input 
                    id="username"
                    type="username" 
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                    class="input"
                    />
                </div>
                <div>
                    <label for="password" class="label">Password</label>
                    <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="input"
                    />
                </div>
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember" 
                        class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer"
                    >
                    <label for="remember" class="ml-2 block text-sm text-slate-600 cursor-pointer select-none">
                        Remember me for 30 days
                    </label>
                </div>
                @error('username')
                    <p class="form-input-error">{{ $message }}</p>
                @enderror
                <div>
                    <button type="submit" class="submit-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>