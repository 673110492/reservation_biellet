@extends('layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Modification de l'agence</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Agences</a></li>
                    <li class="breadcrumb-item active"><a href="#">Modifier</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Formulaire de modification</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('agences.update', $agence->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nom -->
                            <div class="form-group">
                                <input type="text" name="nom" class="form-control" placeholder="Nom de l'agence" value="{{ old('nom', $agence->nom) }}" required>
                                @error('nom')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Adresse -->
                            <div class="form-group">
                                <input type="text" name="adresse" class="form-control" placeholder="Adresse" value="{{ old('adresse', $agence->adresse) }}">
                                @error('adresse')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="form-group">
                                <input type="text" name="telephone" class="form-control" placeholder="Téléphone" value="{{ old('telephone', $agence->telephone) }}">
                                @error('telephone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                <button type="reset" class="btn btn-secondary">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
