<x-layout>
    <x-slot:title>
        Ticket Form
    </x-slot:title>
    

    <div class="mt-2 max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Submit a Support Ticket</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Please describe your issue in detail. Our team typically responds within 24 hours.</p>
        </div>
        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}"
                    required
                    autofocus
                    placeholder="Brief summary of the issue"
                    class="w-full rounded-lg px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-900 border @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 @enderror shadow-sm focus:outline-none focus:ring-2 transition-colors duration-200"
                >
                @error('title')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="6" 
                    required
                    placeholder="Provide as much detail as possible, including steps to reproduce any errors..."
                    class="w-full rounded-lg px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-900 border @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 @enderror shadow-sm focus:outline-none focus:ring-2 transition-colors duration-200"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Category <span class="text-red-500">*</span>
                </label>
                <select 
                    name="category" 
                    id="category" 
                    required
                    class="w-full rounded-lg px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-900 border @error('category') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 @enderror shadow-sm focus:outline-none focus:ring-2 transition-colors duration-200"
                >
                    <option value="" disabled {{ old('category') === null ? 'selected' : '' }}>Select a category</option>
                    
                    {{-- Loop through your Enum cases here --}}
                    @foreach($categories as $category)
                        <option value="{{ $category->value }}" {{ old('category') === $category->value ? 'selected' : '' }}>
                            {{ ucfirst($category->value) }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Your email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    required
                    placeholder="customer@example.com"
                    class="w-full rounded-lg px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-900 border @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 @enderror shadow-sm focus:outline-none focus:ring-2 transition-colors duration-200"
                >
                @error('email')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- File Attachments --}}
            <div x-data="{ 
                files: [], 
                addFiles(newFiles) {
                    // Append new files to our array
                    for (let i = 0; i < newFiles.length; i++) {
                        this.files.push(newFiles[i]);
                    }
                    // Update the actual hidden file input using a DataTransfer object
                    let dt = new DataTransfer();
                    this.files.forEach(file => dt.items.add(file));
                    document.getElementById('attachments').files = dt.files;
                },
                removeFile(index) {
                    // Remove the file from our array
                    this.files.splice(index, 1);
                    
                    // Sync the change back to the hidden file input
                    let dt = new DataTransfer();
                    this.files.forEach(file => dt.items.add(file));
                    document.getElementById('attachments').files = dt.files;
                }
            }" class="space-y-3">
                
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Attachments (Optional)
                </label>

                <!-- Drop Zone Container -->
                <div @dragover.prevent="$el.classList.add('border-indigo-500', 'bg-indigo-50/5') "
                    @dragleave.prevent="$el.classList.remove('border-indigo-500', 'bg-indigo-50/5')"
                    @drop.prevent="
                        $el.classList.remove('border-indigo-500', 'bg-indigo-50/5');
                        addFiles($event.dataTransfer.files);
                    "
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors duration-200 cursor-pointer">
                    
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                            <label for="attachments" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                                <span>Upload files</span>
                                <!-- Notice the x-on:change handler added here -->
                                <input id="attachments" 
                                    name="attachments[]" 
                                    type="file" 
                                    multiple 
                                    class="sr-only"
                                    @change="addFiles($event.target.files)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            PNG, JPG, PDF, DOC up to 10MB each<br>(64MB total)
                        </p>
                    </div>
                </div>

                <!-- File Preview & Delete List -->
                <template x-if="files.length > 0">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700 rounded-md p-3 bg-gray-50 dark:bg-gray-900">
                        <template x-for="(file, index) in files" :key="index">
                            <li class="py-2 flex items-center justify-between text-sm">
                                <div class="flex items-center space-x-2 truncate">
                                    <!-- File Icon / Name -->
                                    <span class="font-medium text-gray-700 dark:text-gray-200 truncate" x-text="file.name"></span>
                                    <span class="text-xs text-gray-400" x-text="`(${(file.size/1024/1024).toFixed(2)} MB)`"></span>
                                </div>
                                <!-- Delete Button -->
                                <button type="button" 
                                        @click="removeFile(index)" 
                                        class="text-red-500 hover:text-red-700 dark:hover:text-red-400 ml-2 text-xs font-semibold">
                                    Remove
                                </button>
                            </li>
                        </template>
                    </ul>
                </template>

                @error('attachments.*')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <button 
                    type="submit" 
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                >
                    Submit Ticket
                </button>
            </div>
        </form>
    </div>
</x-layout>