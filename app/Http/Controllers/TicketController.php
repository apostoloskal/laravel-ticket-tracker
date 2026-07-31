<?php

namespace App\Http\Controllers;

use App\Enums\TicketCategory;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', Ticket::class);

        return view('dashboard.list-tickets');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('create', Ticket::class);

        return view('tickets.create', ['categories' => TicketCategory::cases()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request): RedirectResponse
    {
        Gate::authorize('create', Ticket::class);

        $validated = $request->validated();

        $ticket = Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'email' => $validated['email']
        ]);

        if($request->hasFile('attachments')) {
            foreach($request->file('attachments') as $file) {
                $file->store("tickets/{$ticket->uuid}");
            }
        }

        return redirect()->route('tickets.show', $ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): View
    {
        $ticket = Ticket::with(['assignedEmployee.user', 'comments.employeeProfile.user'])
        ->whereUuid($uuid)->firstOrFail();

        Gate::authorize('view', $ticket);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
