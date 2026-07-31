<x-layout>
    <x-slot:title>
        {{ $title ?? 'Dashboard' }}
    </x-slot:title>

    <div class="flex">
        <x-dashboard-sidebar />
        {{ $slot }}
    </div>
</x-layout>