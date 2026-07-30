<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Rules\TicketTrackingCode;
use Illuminate\Http\Request;

class TicketTrackController extends Controller
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
            'tracking_code' => ['required', 'string', new TicketTrackingCode]
        ]);

        $ticket = Ticket::with('assignedEmployee.user')
        ->whereTrackingCode($validated['tracking_code'])
        ->first();

        if(! $ticket) {
            return back()
            ->withErrors(['tracking_code' => 'No ticket was found with this tracking code.'])
            ->onlyInput('tracking_code');
        }

        return redirect()->route('tickets.show', $ticket->uuid);
    }
}
