<x-layout>
    <x-slot:title>
        Ticket Details
    </x-slot:title>
    

    <div class="mt-2 max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Ticket #{{ $ticket->uuid }}</h1>
            <p>Title:<br>{{$ticket->title}}</p>
            <p>Description:<br>{{$ticket->description}}</p>
        </div>
        
    </div>
</x-layout>