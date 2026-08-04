<?php

namespace App\Http\Controllers\Tickets;

use App\Enums\TicketCategory;
use App\Enums\TicketStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Mail\TicketSubmitted;
use App\Models\Ticket;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', Ticket::class);

        $tickets = Ticket::with(['assignedEmployee.user', 'comments.employeeProfile.user'])
            ->latest()
            ->simplePaginate(10);

        return view('dashboard.list-tickets', compact('tickets'));
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
                $fileName = $file->getClientOriginalName();
                $path = $file->store('attachments', 'public');
                $ticket->attachments()->create([
                    'file_name' => $fileName,
                    'file_path' => $path
                ]);
            }
        }

        Mail::to($ticket->email)->send(new TicketSubmitted($ticket));

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

        return view('tickets.show', ['ticket' => $ticket, 'statuses' => TicketStatus::cases(), 'categories' => TicketCategory::cases()]);
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
    public function update(Request $request, Ticket $ticket)
    {
        Gate::authorize('update', $ticket);

        $validated = $request->validate([
            'status' => ['required', Rule::enum(TicketStatus::class)],
            'category' => ['required', Rule::enum(TicketCategory::class)]
        ]);

        $ticket->update([
            'status' => $validated['status'],
            'category' => $validated['category']
        ]);

        return back()->with('success', 'Ticket properties updated successfully.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        Gate::authorize('assign', $ticket);

        $ticket->update([
            'employee_profile_id' => $request->user()->id
        ]);

        return back()->with('success', 'Ticket successfully assigned to you.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('delete', $ticket);

        Ticket::destroy($ticket->id);

        return back()->with('success', 'Ticket deleted successfully.');
    }
}
