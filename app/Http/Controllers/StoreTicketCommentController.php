<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTicketCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:5000']
        ]);

        $employeeProfileId = Auth::check() ? Auth::user()->employeeProfile->id ?? null : null;

        $ticket->comments()->create([
            'content' => $validated['content'],
            'employee_profile_id' => $employeeProfileId
        ]);

        return back()->with('success', 'Your comment has been posted.');
    }
}
