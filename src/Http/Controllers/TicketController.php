<?php
namespace Paki\Ticketify\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Paki\Ticketify\Models\Ticket;
use Paki\Ticketify\Models\TicketReply;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->paginate(20);
        return view('ticketify::tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('ticketify::tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => auth()->id(),
            'title' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Votre ticket a été créé avec succès.');
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->user_id != auth()->id()) {
            abort(403);
        }

        return view('ticketify::tickets.show', compact('ticket'));
    }

    public function reply(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);

    if ($ticket->user_id != auth()->id()) {
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


    return redirect()->route('tickets.show', $ticket->id)->with('success', 'Réponse ajoutée avec succès.');
}

public function markAsResolved($id)
{
    $ticket = Ticket::findOrFail($id);

    $ticket->update(['status' => 'resolved']);

    return redirect()->route('tickets.index')->with('success', 'Le ticket a été marqué comme résolu.');
}


}
