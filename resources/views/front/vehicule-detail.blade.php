@extends('front.layouts.app')

@section('content')
<section class="ftco-section ftco-car-details">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="car-details border rounded shadow p-4">

                    <div class="img rounded mb-4"
                        style="background-image: url('{{ asset($vehicule->image ? 'storage/' . $vehicule->image : 'images/bg_1.jpg') }}'); height: 300px; background-size: cover; background-position: center;">
                    </div>

                    <div class="text text-center mb-4">
                        <h2 class="fw-bold mb-3">{{ $vehicule->type }} - {{ $vehicule->numero_immatriculation }}</h2>
                        <p><strong>Nombre de places :</strong> {{ $vehicule->nombre_places }}</p>
                        <p><strong>Status :</strong>
                            @if ($vehicule->status == 'plein')
                                <span class="badge bg-danger">Plein</span>
                            @else
                                <span class="badge bg-success">Disponible</span>
                            @endif
                        </p>
                    </div>

                    <hr>

                    <div class="agence-info mb-4">
                        <h4 class="mb-3">Informations sur l'agence</h4>
                        <p><strong>Nom :</strong> {{ $vehicule->agence->nom ?? 'Agence inconnue' }}</p>
                        <p><strong>Adresse :</strong> {{ $vehicule->agence->adresse ?? 'Non renseignée' }}</p>
                        <p><strong>Téléphone :</strong> {{ $vehicule->agence->telephone ?? 'Non renseigné' }}</p>
                    </div>

                    <div class="text-center">
                        <a href="" class="btn btn-primary btn-lg">
                            <i class="fas fa-car"></i> Réserver ce véhicule
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection
