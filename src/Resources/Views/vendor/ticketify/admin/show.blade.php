@extends(config('ticketify.layout_admin','layouts.app'))

@section(config('ticketify.section_admin','content'))
<div class="container mt-4">
    <h1>Ticket #{{ $ticket->id }}</h1>
    <p><strong>Sujet :</strong> {{ $ticket->subject }}</p>
    <p><strong>Description :</strong></p>
    <p>{{ $ticket->description }}</p>
    <p><strong>Statut :</strong> {{ \Paki\Ticketify\Models\Ticket::statuses()[$ticket->status] }}</p>

    <h3>Réponses</h3>
    <div class="card">
        <div class="card-body">
            @foreach($ticket->replies as $reply)
                <div class="mb-3">
                    <strong>{{ $reply->user->name }}</strong> ({{ $reply->created_at->format('d/m/Y H:i') }})
                    <p>{{ $reply->message }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <h3>Ajouter une Réponse</h3>
    <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="message" id="message" rows="4" class="form-control" placeholder="Votre réponse..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
