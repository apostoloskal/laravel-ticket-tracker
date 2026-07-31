<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>
    <div class="min-h-[calc(100vh-250px)] flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-4 py-12">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex flex-col w-full">
                <div class="flex w-full justify-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Login</h2>
                </div>
                <form method="post" action={{ route('login') }} class="space-y-6">
                    <div>
                        <label for="username" class="label">Username</label>
                        <input 
                        id="username"
                        type="username" 
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autofocus
                        class="input @error('username') border-red-500 focus:ring-red-500 focus:border-red-500 
                            @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                            @enderror"
                        />
                    </div>
                    <div>
                        <label for="password" class="label">Password</label>
                        <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="input @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 
                            @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                            @enderror"
                        />
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="w-4 h-4 text-gray-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer"
                        >
                        <label for="remember" class="ml-2 block text-sm text-slate-600 dark:text-white cursor-pointer select-none">
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
    </div>
</x-layout>