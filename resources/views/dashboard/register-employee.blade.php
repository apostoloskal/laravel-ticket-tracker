<x-layout>
    <x-slot:title>
        Register Employee
    </x-slot:title>

    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-12 bg-slate-50
                mt-2 max-w-md mx-auto p-6 dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="flex flex-1 flex-col mb-8 w-full">
            <div class="flex w-full justify-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Register Employee</h2>
            </div>
            <form method="post" action="{{ route('employees.store') }}" class="space-y-6">
                @csrf
                <div class="space-y-4 pt-4">
                    <div>
                        <label for="username" class="label">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input 
                        id="username"
                        type="text" 
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="JohnSmith37"
                        required
                        autofocus
                        class="input @error('username') border-red-500 focus:ring-red-500 focus:border-red-500 
                        @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                        @enderror"
                        />
                    </div>
                    @error('username')
                        <p class="form-input-error">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="email" class="label">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input 
                        id="email"
                        type="email" 
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="johnsmith@example.com"
                        required
                        class="input @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 
                        @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                        @enderror"
                        />
                    </div>
                    @error('email')
                        <p class="form-input-error">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="password" class="label">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="••••••••••"
                        required
                        class="input @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 
                        @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                        @enderror"
                        />
                    </div>
                    @error('password')
                        <p class="form-input-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <div>
                        <label for="full_name" class="label">Full Name</label>
                        <input 
                        id="full_name"
                        type="text" 
                        name="full_name"
                        value="{{ old('full_name') }}"
                        placeholder="John Smith"
                        class="input @error('full_name') border-red-500 focus:ring-red-500 focus:border-red-500 
                        @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                        @enderror"
                        />
                    </div>
                    @error('full_name')
                        <p class="form-input-error">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="job_title" class="label">Job Title</label>
                        <input 
                        id="job_title"
                        type="text" 
                        name="job_title"
                        value="{{ old('job_title') }}"
                        placeholder="Software Engineer"
                        class="input @error('job_title') border-red-500 focus:ring-red-500 focus:border-red-500 
                        @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                        @enderror"
                        />
                    </div>
                    @error('job_title')
                        <p class="form-input-error">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="department" class="label">Department</label>
                        <input 
                        id="department"
                        type="text" 
                        name="department"
                        value="{{ old('department') }}"
                        placeholder="IT"
                        class="input @error('department') border-red-500 focus:ring-red-500 focus:border-red-500 
                        @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 
                        @enderror"
                        />
                    </div>
                    @error('department')
                        <p class="form-input-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit" class="submit-btn">Register</button>
                </div>
                @if (session('success'))
                    <div class="mb-6 flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                        <!-- Checkmark Icon -->
                        <svg class="flex-shrink-0 inline w-5 h-5 me-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="sr-only">Success</span>
                        <div>
                            <span class="font-medium">Success!</span> {{ session('success') }}
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-layout>