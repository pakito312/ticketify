@extends(config('ticketify.layout_admin'))

@section(config('ticketify.section_admin'))
<div class="container mt-4">
    <h1>Tickets Manager</h1>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Tickets</h5>
                    <h3>{{ $totalTickets }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Tickets Ouverts</h5>
                    <h3>{{ $openTickets }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Tickets Résolus</h5>
                    <h3>{{ $resolvedTickets }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5>Tickets Cloturé</h5>
                    <h3>{{ $closeTickets }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Graphiques</h5>
                </div>
                <div class="card-body">
                    <canvas id="ticketChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ticketChart').getContext('2d');
    const ticketChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Ouverts', 'Résolus', 'En Attente'],
            datasets: [{
                data: [{{ $openTickets }}, {{ $resolvedTickets }}, {{ $pendingTickets }}],
                backgroundColor: ['#f39c12', '#00a65a', '#d2d6de'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endpush
