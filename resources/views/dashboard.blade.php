@extends('layouts.app')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="mb-3">
                                <i class="fa fa-car fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Véhicules</h5>
                            <h2 class="card-text font-weight-bold">{{ $totalVehicules }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="mb-3">
                                <i class="fa fa-road fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Trajets</h5>
                            <h2 class="card-text font-weight-bold">{{ $totalTrajets }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="mb-3">
                                <i class="fa fa-calendar-check-o fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title">Réservations</h5>
                            <h2 class="card-text font-weight-bold">{{ $totalReservations }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="mb-3">
                                <i class="fa fa-building fa-3x text-danger"></i>
                            </div>
                            <h5 class="card-title">Agences</h5>
                            <h2 class="card-text font-weight-bold">{{ $totalAgences }}</h2>
                        </div>
                    </div>
                </div>
            </div>

<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Réservations par jour</h4>
            </div>
            <div class="card-body">
                <canvas id="reservationsChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">Total Réservations</h4>
                <h2 class="mt-3" id="totalReservations">{{ number_format($totalReservations) }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('reservationsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven'],
            datasets: [{
                label: 'Test Réservations',
                data: [5, 10, 7, 12, 8],
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }]
        },
        options: {
            responsive: true
        }
    });
});
</script>
@endsection
