@extends(config('ticketify.layout_front', 'layouts.app'))
@section(config('ticketify.section_font', 'content'))
<div class="container mt-4">
    <h1>Liste des Tickets</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Créer un Nouveau Ticket</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Sujet</th>
                <th>Statut</th>
                <th>Date de Création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>
                        @if ($ticket->status === 'open')
                            <span class="badge bg-warning">Ouvert</span>
                        @elseif ($ticket->status === 'resolved')
                            <span class="badge bg-success">Résolu</span>
                        @else
                            <span class="badge bg-secondary">Fermé</span>
                        @endif
                    </td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-info btn-sm">Voir</a>
                        @if ($ticket->status === 'open')
                            <form action="{{ route('tickets.resolve', $ticket) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Résoudre</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tickets->links() }}
</div>
@endsection
