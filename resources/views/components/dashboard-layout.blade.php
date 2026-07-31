<x-layout>
    <x-slot:title>
        {{ $title ?? 'Dashboard' }}
    </x-slot:title>

    <div class="flex min-h-[calc(100vh-250px)]">
        <x-dashboard-sidebar />
        <div class="p-4 w-full h-full">
            {{ $slot }}
        </div>
    </div>
</x-layout>