<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreCommentController extends Controller
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

        $comment = $ticket->comments()->create([
            'content' => $validated['content'],
            'employee_profile_id' => $employeeProfileId
        ]);

        if($request->hasFile('attachments')) {
            foreach($request->file('attachments') as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $file->store('attachments', 'public');
                $comment->attachments()->create([
                    'file_name' => $fileName,
                    'file_path' => $path
                ]);
            }
        }

        return back()->with('success', 'Your comment has been posted.');
    }
}
