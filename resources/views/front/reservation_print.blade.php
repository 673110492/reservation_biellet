<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de réservation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .section {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .box {
            flex: 1;
            min-width: 250px;
        }

        p {
            font-size: 15px;
            margin-bottom: 8px;
        }

        strong {
            color: #555;
        }

        .btn-print {
            display: block;
            margin: 30px auto 0;
            padding: 12px 30px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        @media print {
            .btn-print {
                display: none;
            }
            body {
                background: none;
                padding: 0;
            }
            .container {
                box-shadow: none;
                margin: 0;
                padding: 0;
                border: none;
            }
        }
    </style>
</head>
<body>

<div class="container" id="print-area">
    <h2>Fiche de réservation</h2>

    <!-- Section Client -->
    <div class="section">
        <div class="box">
            <p><strong>Nom :</strong> {{ $reservation->nom }}</p>
            <p><strong>Prénom :</strong> {{ $reservation->prenom }}</p>
            <p><strong>Email :</strong> {{ $reservation->email ?? 'Non renseigné' }}</p>
            <p><strong>Téléphone :</strong> {{ $reservation->telephone }}</p>
        </div>
        <div class="box">
            <p><strong>Adresse :</strong> {{ $reservation->adresse ?? 'Non renseignée' }}</p>
            <p><strong>Genre :</strong> {{ $reservation->genre ?? 'Non précisé' }}</p>
            <p><strong>Date de réservation :</strong> {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</p>
            <p><strong>Nombre de places :</strong> {{ $reservation->nombre_places }}</p>
            <p><strong>Prix total :</strong> {{ number_format($reservation->prix_total, 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <hr>

    <!-- Section Véhicule -->
    <h4>Informations sur le véhicule</h4>
    <div class="section">
        <div class="box">
            <p><strong>Type :</strong> {{ $reservation->vehicule->type ?? 'Non disponible' }}</p>
            <p><strong>Immatriculation :</strong> {{ $reservation->vehicule->numero_immatriculation ?? 'N/A' }}</p>
        </div>
        <div class="box">
            <p><strong>Statut :</strong>
                @if($reservation->vehicule->status === 'plein')
                    Plein
                @else
                    Disponible
                @endif
            </p>
            <p><strong>Places totales :</strong> {{ $reservation->vehicule->nombre_places ?? 'N/A' }}</p>
        </div>
    </div>

    <hr>

    <!-- Section Agence -->
    <h4>Informations sur l'agence</h4>
    <div class="section">
        <div class="box">
            <p><strong>Nom :</strong> {{ $reservation->agence->nom ?? 'Agence inconnue' }}</p>
            <p><strong>Adresse :</strong> {{ $reservation->agence->adresse ?? 'Non renseignée' }}</p>
        </div>
        <div class="box">
            <p><strong>Téléphone :</strong> {{ $reservation->agence->telephone ?? 'Non renseigné' }}</p>
        </div>
    </div>

    <hr>

    <!-- Section Trajet -->
    <h4>Trajet</h4>
    <div class="section">
        <div class="box">
            <p><strong>Trajet :</strong> {{ $reservation->trajet->depart ?? 'N/A' }} → {{ $reservation->trajet->arrivee ?? 'N/A' }}</p>
        </div>
    </div>

    <button class="btn-print" onclick="window.print()">Imprimer</button>
</div>

</body>
</html>
