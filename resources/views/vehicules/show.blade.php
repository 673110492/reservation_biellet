@extends('layouts.app')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Détails de l'Agence</h4>
                        <span class="ml-1">Affichage des informations de l'agence</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('agences.index') }}">Agences</a></li>
                        <li class="breadcrumb-item active">Détails</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $agence->nom }}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Nom :</strong> {{ $agence->nom }}</p>
                            <p><strong>Adresse :</strong> {{ $agence->adresse }}</p>
                            <p><strong>Téléphone :</strong> {{ $agence->telephone }}</p>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('agences.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
