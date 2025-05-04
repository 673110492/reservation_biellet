@extends('layouts.app')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <span class="ml-1">Datatable</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Header avec bouton Ajouter -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Liste des vehicules</h4>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"data-bs-target="#addVehiculeModal">
                                <i class="material-icons">add</i> Ajouter une vehicule
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Nombre de place</th>
                                            <th>Agence</th>
                                            <th>Type</th>
                                            <th>Immatriculation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicules as $vehicule)
                                            <tr>
                                                <td>{{ $vehicule->nombre_places }}</td>
                                                <td>{{ $vehicule->agence->nom ?? 'N/A' }}</td>
                                                <td>{{ $vehicule->type ?? 'N/A' }}</td>
                                                <td>{{ $vehicule->numero_immatriculation }}</td>
                                                <td>
                                                    <a href="{{ route('vehicules.show', $vehicule->id) }}" class="btn btn-info btn-sm">
                                                        <i class="material-icons">visibility</i>
                                                    </a>

                                                    <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="material-icons">edit</i>
                                                    </a>

                                                    <!-- Bouton pour ouvrir le modal de suppression -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $vehicule->id }}">
                                                        <i class="material-icons">delete</i>
                                                    </button>

                                                    <!-- Modal de confirmation de suppression -->
                                                    <div class="modal fade" id="deleteModal{{ $vehicule->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $vehicule->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteModalLabel{{ $vehicule->id }}">Confirmer la suppression</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Voulez-vous vraiment supprimer l’vehicule <strong>{{ $vehicule->nom }}</strong> ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Fin modal -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal d'ajout d'vehicule -->
                            <div class="modal fade" id="addVehiculeModal" tabindex="-1" aria-labelledby="addVehiculeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('vehicules.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ajouter un véhicule</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="numero_immatriculation" class="form-label">Numéro d'immatriculation</label>
                                                    <input type="text" name="numero_immatriculation" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type</label>
                                                    <input type="text" name="type" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nombre_places" class="form-label">Nombre de places</label>
                                                    <input type="number" name="nombre_places" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="agence_id" class="form-label">Agence</label>
                                                    <select name="agence_id" class="form-control" required>
                                                        <option value="">-- Sélectionner une agence --</option>
                                                        @foreach ($agences as $agence)
                                                            <option value="{{ $agence->id }}">{{ $agence->nom }}</option>
                                                        @endforeach
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
                            <!-- Fin modal ajout -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assurez-vous que Bootstrap JS est bien chargé dans layouts.app -->
@endsection
