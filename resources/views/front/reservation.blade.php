@extends('front.layouts.app')

@section('content')
    <!-- SECTION HERO -->
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets1/images/bus1.jpeg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ url('/') }}">Accueil <i
                                    class="ion-ios-arrow-forward"></i></a></span>
                        <span>Réservation <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                    <h1 class="mb-3 bread">Formulaire de réservation</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION CONTACT & FORMULAIRE -->
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">

                <!-- INFORMATIONS DE CONTACT -->
                <div class="col-md-4">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-map-o"></span>
                                </div>
                                <p><strong>Adresse :</strong> 198 West 21th Street, Suite 721 New York NY 10016</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-mobile-phone"></span>
                                </div>
                                <p><strong>Téléphone :</strong> <a href="tel://1234567920">+1235 2355 98</a></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-envelope-o"></span>
                                </div>
                                <p><strong>Email :</strong> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORMULAIRE DE RÉSERVATION -->
                <!-- FORMULAIRE DE RÉSERVATION -->
               <div class="col-md-8 block-9 mb-md-5">
    <form action="{{ route('reservation.store') }}" method="POST" class="bg-light p-5 contact-form">
        @csrf

        <div class="row">
            <!-- Nom & Prénom -->
            <div class="form-group col-md-6">
                <input type="text" name="nom" class="form-control" placeholder="Nom" required>
            </div>
            <div class="form-group col-md-6">
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
            </div>

            <!-- Email & Téléphone -->
            <div class="form-group col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Email (optionnel)">
            </div>
            <div class="form-group col-md-6">
                <input type="text" name="telephone" class="form-control" placeholder="Téléphone" required>
            </div>

            <!-- Adresse & Genre -->
            <div class="form-group col-md-6">
                <input type="text" name="adresse" class="form-control" placeholder="Adresse (optionnel)">
            </div>
            <div class="form-group col-md-6">
                <select name="genre" class="form-control">
                    <option value="">Sélectionnez le genre</option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            <!-- Date & Nombre de places -->
            <div class="form-group col-md-6">
                <input type="date" name="date_reservation" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <input type="number" name="nombre_places" class="form-control" placeholder="Nombre de places" min="1" required>
            </div>

            <!-- Sélection du véhicule -->
            <div class="form-group col-md-6">
                <select name="vehicule_id" class="form-control" required>
                    <option value="">Sélectionnez un véhicule</option>
                    @foreach ($vehicules as $vehicule)
                        @php
                            $placesReservees = $vehicule->reservations->sum('nombre_places');
                            $placesRestantes = $vehicule->nombre_places - $placesReservees;
                        @endphp

                        @if ($placesRestantes > 0)
                            <option value="{{ $vehicule->id }}">
                                {{ $vehicule->type }} - {{ $vehicule->numero_immatriculation }} ({{ $placesRestantes }} places restantes)
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Agence -->
            <div class="form-group col-md-6">
                <select name="agence_id" class="form-control" required>
                    <option value="">Sélectionnez une agence</option>
                    @foreach ($agences as $agence)
                        <option value="{{ $agence->id }}">{{ $agence->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Trajet -->
            <div class="form-group col-md-12">
                <select name="trajet_id" class="form-control" required>
                    <option value="">Sélectionnez un trajet</option>
                    @foreach ($trajets as $trajet)
                        <option value="{{ $trajet->id }}">
                            {{ $trajet->depart }} → {{ $trajet->arrivee }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="form-group text-center mt-3">
            <input type="submit" value="Réserver" class="btn btn-primary py-3 px-5">
        </div>

        <!-- Messages -->
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

    </form>
</div>


            </div>

            <!-- CARTE MAP -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div id="map" class="bg-white" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
