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
                            <h4 class="card-title">Liste des agences</h4>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAgenceModal">
                                <i class="material-icons">add</i> Ajouter une agence
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Adresse</th>
                                            <th>Téléphone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agences as $agence)
                                            <tr>
                                                <td>{{ $agence->nom }}</td>
                                                <td>{{ $agence->adresse ?? 'N/A' }}</td>
                                                <td>{{ $agence->telephone }}</td>
                                                <td>
                                                    <a href="{{ route('agences.show', $agence->id) }}" class="btn btn-info btn-sm">
                                                        <i class="material-icons">visibility</i>
                                                    </a>

                                                    <a href="{{ route('agences.edit', $agence->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="material-icons">edit</i>
                                                    </a>

                                                    <!-- Bouton pour ouvrir le modal de suppression -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $agence->id }}">
                                                        <i class="material-icons">delete</i>
                                                    </button>

                                                    <!-- Modal de confirmation de suppression -->
                                                    <div class="modal fade" id="deleteModal{{ $agence->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $agence->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <form action="{{ route('agences.destroy', $agence->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteModalLabel{{ $agence->id }}">Confirmer la suppression</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Voulez-vous vraiment supprimer l’agence <strong>{{ $agence->nom }}</strong> ?
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

                            <!-- Modal d'ajout d'agence -->
                            <div class="modal fade" id="addAgenceModal" tabindex="-1" aria-labelledby="addAgenceModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('agences.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addAgenceModalLabel">Ajouter une agence</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" name="nom" id="nom" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="adresse" class="form-label">Adresse</label>
                                                    <input type="text" class="form-control" name="adresse" id="adresse">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telephone" class="form-label">Téléphone</label>
                                                    <input type="text" class="form-control" name="telephone" id="telephone" required>
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
