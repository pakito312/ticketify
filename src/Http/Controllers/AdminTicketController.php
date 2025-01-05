<?php

namespace Paki\Ticketify\Http\Controllers;

use Illuminate\Http\Request;
use Paki\Ticketify\Models\Ticket;

class AdminTicketController extends Controller
{
    public function dashboard()
    {
        return view('ticketify::admin.dashboard', [
            'totalTickets' => Ticket::count(),
            'openTickets' => Ticket::where('status', 'open')->count(),
            'resolvedTickets' => Ticket::where('status', 'resolved')->count(),
            'closeTickets' => Ticket::where('status', 'close')->count(),
        ]);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('ticketify::admin.show', compact('ticket'));
    }

    public function reply(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
    
        if ($ticket->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }
    
        $validated = $request->validate([
            'message' => 'required|string',
        ]);
    
        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $validated['message'],
        ]);
    
        if ($ticket->status == 'resolved' || $ticket->status == 'close') {
            $ticket->update(['status' => 'open']);
        }
    
        return redirect()->route('admin.tickets.show', $ticket->id)->with('success', 'Réponse ajoutée avec succès.');
    }
}
