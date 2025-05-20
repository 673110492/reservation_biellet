@extends('layouts.app')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <!-- Messages de succès et erreurs -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Breadcrumb -->
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Liste des réservations</h4>
                        <span class="ml-1">Datatable</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Réservations</a></li>
                        <li class="breadcrumb-item active"><a href="#">Liste</a></li>
                    </ol>
                </div>
            </div>

            <!-- Table des réservations -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Réservations</h4>
                            <!-- Bouton pour ouvrir le modal d'ajout -->
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalAddReservation">
                                <i class="material-icons">add</i> Ajouter une réservation
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 1000px">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Téléphone</th>
                                            <th>Véhicule</th>
                                            <th>Agence</th>
                                            <th>Trajet</th>
                                            <th>Places</th>
                                            <th>Prix total</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservations as $reservation)
                                            <tr>
                                                <td>{{ $reservation->nom }}</td>
                                                <td>{{ $reservation->telephone }}</td>
                                                <td>{{ $reservation->vehicule->numero_immatriculation ?? 'N/A' }}</td>
                                                <td>{{ $reservation->agence->nom ?? 'N/A' }}</td>
                                                <td>{{ $reservation->trajet->depart ?? 'N/A' }} →
                                                    {{ $reservation->trajet->arrivee ?? 'N/A' }}</td>
                                                <td>{{ $reservation->nombre_places }}</td>
                                                <td>{{ number_format($reservation->prix_total, 2, ',', ' ') }} F</td>
                                                <td>
                                                    @php
                                                        $colors = [
                                                            'en_attente' => 'warning',
                                                            'confirmee' => 'success',
                                                            'annulee' => 'danger',
                                                        ];
                                                    @endphp
                                                    <span
                                                        class="badge bg-{{ $colors[$reservation->statut] ?? 'secondary' }}">
                                                        {{ ucfirst($reservation->statut) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- Bouton voir -->
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalReservation{{ $reservation->id }}"
                                                        title="Voir">
                                                        <i class="material-icons">visibility</i>
                                                    </button>

                                                    <!-- Bouton éditer -->
                                                    <a href="{{ route('reservations.edit', $reservation->id) }}"
                                                        class="btn btn-warning btn-sm" title="Éditer">
                                                        <i class="material-icons">edit</i>
                                                    </a>

                                                    <!-- Bouton changer statut -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalChangeStatus{{ $reservation->id }}"
                                                        title="Changer statut">
                                                        <i class="material-icons">autorenew</i>
                                                    </button>

                                                    <!-- Formulaire suppression -->
                                                    <form action="{{ route('reservations.destroy', $reservation->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Supprimer"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>

                                            <!-- Modal Bootstrap changer statut réservation -->
                                            <div class="modal fade" id="modalChangeStatus{{ $reservation->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modalChangeStatusLabel{{ $reservation->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form
                                                        action="{{ route('reservations.updateStatus', $reservation->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalChangeStatusLabel{{ $reservation->id }}">
                                                                    Changer le statut</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="statut{{ $reservation->id }}"
                                                                        class="form-label">Statut</label>
                                                                    <select name="statut"
                                                                        id="statut{{ $reservation->id }}"
                                                                        class="form-select" required>
                                                                        <option value="en_attente"
                                                                            {{ $reservation->statut == 'en_attente' ? 'selected' : '' }}>
                                                                            En attente</option>
                                                                        <option value="confirmee"
                                                                            {{ $reservation->statut == 'confirmee' ? 'selected' : '' }}>
                                                                            Confirmée</option>
                                                                        <option value="annulee"
                                                                            {{ $reservation->statut == 'annulee' ? 'selected' : '' }}>
                                                                            Annulée</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Enregistrer</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Annuler</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>


                                            <!-- Modal Bootstrap détail réservation -->
                                            <div class="modal fade" id="modalReservation{{ $reservation->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modalReservationLabel{{ $reservation->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalReservationLabel{{ $reservation->id }}">Détails
                                                                réservation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Fermer"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Infos réservation -->
                                                            <p><strong>Nom:</strong> {{ $reservation->nom }}</p>
                                                            <p><strong>Prénom:</strong> {{ $reservation->prenom }}</p>
                                                            <p><strong>Téléphone:</strong> {{ $reservation->telephone }}
                                                            </p>
                                                            <p><strong>Email:</strong> {{ $reservation->email ?? 'N/A' }}
                                                            </p>
                                                            <p><strong>Date de réservation:</strong>
                                                                {{ $reservation->date_reservation }}</p>
                                                            <p><strong>Nombre de places:</strong>
                                                                {{ $reservation->nombre_places }}</p>
                                                            <p><strong>Prix total:</strong>
                                                                {{ number_format($reservation->prix_total, 2, ',', ' ') }}
                                                                F</p>
                                                            <p><strong>Statut:</strong> {{ ucfirst($reservation->statut) }}
                                                            </p>
                                                            <p><strong>Adresse:</strong>
                                                                {{ $reservation->adresse ?? 'N/A' }}</p>
                                                            <p><strong>Genre:</strong> {{ $reservation->genre ?? 'N/A' }}
                                                            </p>

                                                            <hr>

                                                            <!-- Infos véhicule -->
                                                            <h5>Véhicule</h5>
                                                            @if ($reservation->vehicule)
                                                                <p><strong>Immatriculation:</strong>
                                                                    {{ $reservation->vehicule->numero_immatriculation }}
                                                                </p>
                                                                <p><strong>Type:</strong>
                                                                    {{ $reservation->vehicule->type }}</p>
                                                                <p><strong>Nombre de places:</strong>
                                                                    {{ $reservation->vehicule->nombre_places }}</p>
                                                                <p><strong>Statut:</strong>
                                                                    {{ ucfirst($reservation->vehicule->status) }}</p>
                                                                @if ($reservation->vehicule->image)
                                                                    <p><strong>Image:</strong></p>
                                                                    <img src="{{ asset('storage/' . $reservation->vehicule->image) }}"
                                                                        alt="Image Véhicule" width="120">
                                                                @else
                                                                    <p><strong>Image:</strong> N/A</p>
                                                                @endif
                                                            @else
                                                                <p>Informations véhicule non disponibles</p>
                                                            @endif

                                                            <hr>

                                                            <!-- Infos agence -->
                                                            <h5>Agence</h5>
                                                            @if ($reservation->agence)
                                                                <p><strong>Nom:</strong> {{ $reservation->agence->nom }}
                                                                </p>
                                                                <p><strong>Adresse:</strong>
                                                                    {{ $reservation->agence->adresse ?? 'N/A' }}</p>
                                                                <p><strong>Téléphone:</strong>
                                                                    {{ $reservation->agence->telephone ?? 'N/A' }}</p>
                                                            @else
                                                                <p>Informations agence non disponibles</p>
                                                            @endif

                                                            <hr>

                                                            <!-- Infos trajet -->
                                                            <h5>Trajet</h5>
                                                            @if ($reservation->trajet)
                                                                <p><strong>Départ:</strong>
                                                                    {{ $reservation->trajet->depart }}</p>
                                                                <p><strong>Arrivée:</strong>
                                                                    {{ $reservation->trajet->arrivee }}</p>
                                                                <p><strong>Prix:</strong>
                                                                    {{ number_format($reservation->trajet->prix, 2, ',', ' ') }}
                                                                    F</p>
                                                                <p><strong>Durée:</strong>
                                                                    {{ $reservation->trajet->duree }}</p>
                                                                <p><strong>Distance (km):</strong>
                                                                    {{ $reservation->trajet->distance_km ?? 'N/A' }}</p>
                                                                <p><strong>Date et heure de départ:</strong>
                                                                    {{ $reservation->trajet->date_heure_depart ? $reservation->trajet->date_heure_depart : 'N/A' }}
                                                                </p>
                                                            @else
                                                                <p>Informations trajet non disponibles</p>
                                                            @endif

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination si nécessaire -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bootstrap ajout réservation (en dehors de la boucle) -->
    <div class="modal fade" id="modalAddReservation" tabindex="-1" aria-labelledby="modalAddReservationLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddReservationLabel">Ajouter une réservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <div class="modal-body">
                    <!-- Formulaire de création -->
                    <form action="{{ route('reservations.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom"
                                    value="{{ old('nom') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom *</label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                    value="{{ old('prenom') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email (optionnel)</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Téléphone *</label>
                                <input type="text" class="form-control" id="telephone" name="telephone"
                                    value="{{ old('telephone') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse (optionnel)</label>
                            <input type="text" class="form-control" id="adresse" name="adresse"
                                value="{{ old('adresse') }}">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="genre" class="form-label">Genre</label>
                                <select class="form-select" id="genre" name="genre">
                                    <option value="" selected>-- Choisir --</option>
                                    <option value="Homme" {{ old('genre') == 'Homme' ? 'selected' : '' }}>Homme</option>
                                    <option value="Femme" {{ old('genre') == 'Femme' ? 'selected' : '' }}>Femme</option>
                                    <option value="Autre" {{ old('genre') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="date_reservation" class="form-label">Date de réservation *</label>
                                <input type="date" class="form-control" id="date_reservation" name="date_reservation"
                                    value="{{ old('date_reservation') ?? date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nombre_places" class="form-label">Nombre de places *</label>
                                <input type="number" class="form-control" id="nombre_places" name="nombre_places"
                                    min="1" value="{{ old('nombre_places', 1) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="vehicule_id" class="form-label">Véhicule *</label>
                            <select class="form-select" id="vehicule_id" name="vehicule_id" required>
                                <option value="" selected>-- Sélectionner un véhicule --</option>
                                @foreach ($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}"
                                        {{ old('vehicule_id') == $vehicule->id ? 'selected' : '' }}>
                                        {{ $vehicule->numero_immatriculation }} ({{ $vehicule->type }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="agence_id" class="form-label">Agence *</label>
                            <select class="form-select" id="agence_id" name="agence_id" required>
                                <option value="" selected>-- Sélectionner une agence --</option>
                                @foreach ($agences as $agence)
                                    <option value="{{ $agence->id }}"
                                        {{ old('agence_id') == $agence->id ? 'selected' : '' }}>
                                        {{ $agence->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="trajet_id" class="form-label">Trajet *</label>
                            <select class="form-select" id="trajet_id" name="trajet_id" required>
                                <option value="" selected>-- Sélectionner un trajet --</option>
                                @foreach ($trajets as $trajet)
                                    <option value="{{ $trajet->id }}"
                                        {{ old('trajet_id') == $trajet->id ? 'selected' : '' }}>
                                        {{ $trajet->ville_depart }} → {{ $trajet->ville_arrivee }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
