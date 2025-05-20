@extends('layouts.app')

@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <!-- Messages succès et erreurs -->
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
                        <h4>Gestion des trajets</h4>
                        <span class="ml-1">Datatable</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Table</a></li>
                        <li class="breadcrumb-item active"><a href="#">Trajets</a></li>
                    </ol>
                </div>
            </div>

            <!-- Table des trajets -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Liste des trajets</h4>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addTrajetModal">
                                <i class="material-icons">add</i> Ajouter un trajet
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="trajetsTable" class="table table-striped" style="min-width: 900px">
                                    <thead>
                                        <tr>
                                            <th>Départ</th>
                                            <th>Destination</th>
                                            <th>Date de départ</th>
                                            <th>Prix (FCFA)</th>
                                            <th>Véhicule</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trajets as $trajet)
                                            <tr>
                                                <td>{{ $trajet->depart }}</td>
                                                <td>{{ $trajet->arrivee }}</td>
                                                <td>{{ \Carbon\Carbon::parse($trajet->date_heure_depart)->format('d/m/Y H:i') }}
                                                </td>
                                                <td>{{ number_format($trajet->prix, 0, ',', ' ') }}</td>
                                                <td>{{ $trajet->vehicule->numero_immatriculation ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('trajets.show', $trajet->id) }}"
                                                        class="btn btn-info btn-sm" title="Voir">
                                                        <i class="material-icons">visibility</i>
                                                    </a>

                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editTrajetModal{{ $trajet->id }}"
                                                        title="Modifier">
                                                        <i class="material-icons">edit</i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteTrajetModal{{ $trajet->id }}"
                                                        title="Supprimer">
                                                        <i class="material-icons">delete</i>
                                                    </button>



                                                    <!-- Modal suppression -->
                                                    <div class="modal fade" id="deleteTrajetModal{{ $trajet->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="deleteTrajetLabel{{ $trajet->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('trajets.destroy', $trajet->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteTrajetLabel{{ $trajet->id }}">
                                                                            Confirmer la suppression</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Êtes-vous sûr de vouloir supprimer ce trajet de
                                                                            <strong>{{ $trajet->depart }}</strong> à
                                                                            <strong>{{ $trajet->arrivee }}</strong> ? Cette
                                                                            action est irréversible.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Supprimer</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Fin modal suppression -->


                                                    <!-- Modal édition -->
                                                    <div class="modal fade" id="editTrajetModal{{ $trajet->id }}"
                                                        tabindex="-1" aria-labelledby="editTrajetLabel{{ $trajet->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('trajets.update', $trajet->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editTrajetLabel{{ $trajet->id }}">
                                                                            Modifier le trajet</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Départ</label>
                                                                            <input type="text" name="depart"
                                                                                class="form-control"
                                                                                value="{{ old('depart', $trajet->depart) }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Arrivée</label>
                                                                            <input type="text" name="arrivee"
                                                                                class="form-control"
                                                                                value="{{ old('arrivee', $trajet->arrivee) }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Date et heure de
                                                                                départ</label>
                                                                            <input type="datetime-local"
                                                                                name="date_heure_depart"
                                                                                class="form-control"
                                                                                value="{{ old('date_heure_depart', \Carbon\Carbon::parse($trajet->date_heure_depart)->format('Y-m-d\TH:i')) }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Durée</label>
                                                                            <input type="time" name="duree"
                                                                                class="form-control"
                                                                                value="{{ old('duree', $trajet->duree) }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Prix (FCFA)</label>
                                                                            <input type="number" step="0.01"
                                                                                name="prix" class="form-control"
                                                                                value="{{ old('prix', $trajet->prix) }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Distance (km)</label>
                                                                            <input type="number" step="0.01"
                                                                                name="distance_km" class="form-control"
                                                                                value="{{ old('distance_km', $trajet->distance_km) }}">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Véhicule</label>
                                                                            <select name="vehicule_id"
                                                                                class="form-control" required>
                                                                                <option value="">-- Sélectionner un
                                                                                    véhicule --</option>
                                                                                @foreach ($vehicules as $vehicule)
                                                                                    <option value="{{ $vehicule->id }}"
                                                                                        {{ old('vehicule_id', $trajet->vehicule_id) == $vehicule->id ? 'selected' : '' }}>
                                                                                        {{ $vehicule->numero_immatriculation }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success">Enregistrer</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Fin modal édition -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="addTrajetModal" tabindex="-1" aria-labelledby="addTrajetLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('trajets.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTrajetLabel">Ajouter un trajet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Départ</label>
                                    <input type="text" name="depart" class="form-control"
                                        value="{{ old('depart') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Arrivée</label>
                                    <input type="text" name="arrivee" class="form-control"
                                        value="{{ old('arrivee') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date et heure de départ</label>
                                    <input type="datetime-local" name="date_heure_depart" class="form-control"
                                        value="{{ old('date_heure_depart') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Durée</label>
                                    <input type="time" name="duree" class="form-control"
                                        value="{{ old('duree') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Prix (FCFA)</label>
                                    <input type="number" step="0.01" name="prix" class="form-control"
                                        value="{{ old('prix') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Distance (km)</label>
                                    <input type="number" step="0.01" name="distance_km" class="form-control"
                                        value="{{ old('distance_km') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Véhicule</label>
                                    <select name="vehicule_id" class="form-control" required>
                                        <option value="">-- Sélectionner un véhicule --</option>
                                        @foreach ($vehicules as $vehicule)
                                            <option value="{{ $vehicule->id }}"
                                                {{ old('vehicule_id') == $vehicule->id ? 'selected' : '' }}>
                                                {{ $vehicule->numero_immatriculation }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Statut</label>
                                    <select name="status" class="form-control" required>
                                        <option value="actif" {{ old('status') == 'actif' ? 'selected' : '' }}>Actif
                                        </option>
                                        <option value="inactif" {{ old('status') == 'inactif' ? 'selected' : '' }}>Inactif
                                        </option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
