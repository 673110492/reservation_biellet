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
                        <h4>Hi, welcome back!</h4>
                        <span class="ml-1">Datatable</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Table</a></li>
                        <li class="breadcrumb-item active"><a href="#">Datatable</a></li>
                    </ol>
                </div>
            </div>

            <!-- Table des véhicules -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Liste des véhicules</h4>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addVehiculeModal">
                                <i class="material-icons">add</i> Ajouter un véhicule
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 1000px">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Type</th>
                                            <th>Places</th>
                                            <th>places réservées</th>
                                            <th>Image</th>
                                            <th>Statut</th>
                                            <th>Agence</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicules as $vehicule)
                                            <tr>
                                                <td>{{ $vehicule->numero_immatriculation }}</td>
                                                <td>{{ $vehicule->type }}</td>
                                                <td>{{ $vehicule->nombre_places }}</td>
                                                <td>{{ $vehicule->reservations_sum_nombre_places ?? 0 }} places réservées</td>


                                                <td>
                                                    @if ($vehicule->image)
                                                        <img src="{{ asset('storage/' . $vehicule->image) }}" alt="Image"
                                                            width="60" height="40">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $vehicule->status === 'plein' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($vehicule->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $vehicule->agence->nom ?? 'N/A' }}</td>
                                                <td>
                                                    <!-- Voir -->
                                                    <a href="{{ route('vehicules.show', $vehicule->id) }}"
                                                        class="btn btn-info btn-sm" title="Voir">
                                                        <i class="material-icons">visibility</i>
                                                    </a>

                                                    

                                                    <!-- Éditer -->
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editVehiculeModal{{ $vehicule->id }}"
                                                        title="Éditer">
                                                        <i class="material-icons">edit</i>
                                                    </button>

                                                    <!-- Toggle Statut -->
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#toggleStatusModal{{ $vehicule->id }}"
                                                        title="Changer le statut">
                                                        <i class="material-icons">autorenew</i>
                                                    </button>

                                                    <!-- Modal Toggle Statut -->
                                                    <div class="modal fade" id="toggleStatusModal{{ $vehicule->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="toggleStatusLabel{{ $vehicule->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form
                                                                    action="{{ route('vehicules.toggleStatus', $vehicule->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="toggleStatusLabel{{ $vehicule->id }}">
                                                                            Changer le statut</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Voulez-vous vraiment changer le statut du véhicule
                                                                        <strong>{{ $vehicule->numero_immatriculation }}</strong>
                                                                        de <strong>{{ $vehicule->status }}</strong> à
                                                                        <strong>{{ $vehicule->status === 'plein' ? 'vide' : 'plein' }}</strong>
                                                                        ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Confirmer</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Modification -->
                                                    <div class="modal fade" id="editVehiculeModal{{ $vehicule->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="editVehiculeLabel{{ $vehicule->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form
                                                                    action="{{ route('vehicules.update', $vehicule->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editVehiculeLabel{{ $vehicule->id }}">
                                                                            Modifier le véhicule</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                for="numero_immatriculation{{ $vehicule->id }}"
                                                                                class="form-label">Numéro
                                                                                d'immatriculation</label>
                                                                            <input type="text"
                                                                                name="numero_immatriculation"
                                                                                value="{{ old('numero_immatriculation', $vehicule->numero_immatriculation) }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="type{{ $vehicule->id }}"
                                                                                class="form-label">Type</label>
                                                                            <input type="text" name="type"
                                                                                value="{{ old('type', $vehicule->type) }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="nombre_places{{ $vehicule->id }}"
                                                                                class="form-label">Nombre de places</label>
                                                                            <input type="number" name="nombre_places"
                                                                                value="{{ old('nombre_places', $vehicule->nombre_places) }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="image{{ $vehicule->id }}"
                                                                                class="form-label">Image</label>
                                                                            <input type="file" name="image"
                                                                                class="form-control" accept="image/*">
                                                                            @if ($vehicule->image)
                                                                                <small>Image actuelle :</small><br>
                                                                                <img src="{{ asset('storage/' . $vehicule->image) }}"
                                                                                    alt="Image" width="100"
                                                                                    height="70">
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="status{{ $vehicule->id }}"
                                                                                class="form-label">Statut</label>
                                                                            <select name="status" class="form-control"
                                                                                required>
                                                                                <option value="plein"
                                                                                    {{ old('status', $vehicule->status) === 'plein' ? 'selected' : '' }}>
                                                                                    plein</option>
                                                                                <option value="vide"
                                                                                    {{ old('status', $vehicule->status) === 'vide' ? 'selected' : '' }}>
                                                                                    vide</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="agence_id{{ $vehicule->id }}"
                                                                                class="form-label">Agence</label>
                                                                            <select name="agence_id" class="form-control"
                                                                                required>
                                                                                <option value="">-- Sélectionner une
                                                                                    agence --</option>
                                                                                @foreach ($agences as $agence)
                                                                                    <option value="{{ $agence->id }}"
                                                                                        {{ old('agence_id', $vehicule->agence_id) == $agence->id ? 'selected' : '' }}>
                                                                                        {{ $agence->nom }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Enregistrer</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Fin modal modification -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal d'ajout -->
                            <div class="modal fade" id="addVehiculeModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('vehicules.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ajouter un véhicule</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="numero_immatriculation" class="form-label">Numéro
                                                        d'immatriculation</label>
                                                    <input type="text" name="numero_immatriculation"
                                                        value="{{ old('numero_immatriculation') }}" class="form-control"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type</label>
                                                    <input type="text" name="type" value="{{ old('type') }}"
                                                        class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nombre_places" class="form-label">Nombre de places</label>
                                                    <input type="number" name="nombre_places"
                                                        value="{{ old('nombre_places') }}" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" name="image" class="form-control"
                                                        accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Statut</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="plein"
                                                            {{ old('status') === 'plein' ? 'selected' : '' }}>plein
                                                        </option>
                                                        <option value="vide"
                                                            {{ old('status') === 'vide' ? 'selected' : '' }}>vide</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="agence_id" class="form-label">Agence</label>
                                                    <select name="agence_id" class="form-control" required>
                                                        <option value="">-- Sélectionner une agence --</option>
                                                        @foreach ($agences as $agence)
                                                            <option value="{{ $agence->id }}"
                                                                {{ old('agence_id') == $agence->id ? 'selected' : '' }}>
                                                                {{ $agence->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Annuler</button>
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
@endsection
