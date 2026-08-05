<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Rules\TicketTrackingCode;
use Illuminate\Http\Request;

class TrackTicketController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->isMethod('get')) {
            return view('tickets.track');
        }

        $validated = $request->validate([
            'tracking_code' => ['required', 'string', new TicketTrackingCode],
            'email' => ['required', 'email']
        ]);

        $ticket = Ticket::with('assignedEmployee.user')
        ->whereTrackingCode($validated['tracking_code'])
        ->where('email', $validated['email'])
        ->first();

        if(! $ticket) {
            return back()
            ->withErrors([
                'error' => 'No ticket was found with this tracking code and email.',
            ])
            ->onlyInput('tracking_code', 'email');
        }

        return redirect()->route('tickets.show', $ticket->uuid);
    }
}
