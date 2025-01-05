@extends(config('ticketify.layout_admin'))

@section(config('ticketify.section_admin'))
<div class="container mt-4">
    <h1>Tickets des Utilisateurs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Sujet</th>
                <th>Statut</th>
                <th>Dernière Réponse</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>@if ($ticket->status === 'open')
                        <span class="badge bg-warning">Ouvert</span>
                    @elseif ($ticket->status === 'resolved')
                        <span class="badge bg-success">Résolu</span>
                    @else
                        <span class="badge bg-secondary">Fermé</span>
                    @endif</td>
                    <td>
                        @if($ticket->replies->last())
                            {{ $ticket->replies->last()->message }}
                        @else
                            Aucune réponse
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">Voir</a>
                        @if ($ticket->status === 'open')
                            <form action="{{ route('admin.tickets.close', $ticket) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Clôturer</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
