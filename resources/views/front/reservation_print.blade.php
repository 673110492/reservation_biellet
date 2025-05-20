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
            max-width: 700px;
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

        p {
            font-size: 16px;
            margin-bottom: 10px;
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

    <p><strong>Nom :</strong> Jean</p>
    <p><strong>Prénom :</strong> Dupont</p>
    <p><strong>Email :</strong> jean.dupont@email.com</p>
    <p><strong>Téléphone :</strong> +237 691 23 45 67</p>
    <p><strong>Adresse :</strong> Yaoundé, Cameroun</p>
    <p><strong>Genre :</strong> Homme</p>
    <p><strong>Date de réservation :</strong> 21/05/2025</p>
    <p><strong>Nombre de places :</strong> 2</p>

    <p><strong>Véhicule :</strong> Bus - CE123AA</p>
    <p><strong>Agence :</strong> Express Voyages</p>
    <p><strong>Trajet :</strong> Douala → Bafoussam</p>

    <button class="btn-print" onclick="window.print()">Imprimer</button>
</div>

<script>
    window.addEventListener('load', () => {
        window.print();
    });
</script>

</body>
</html>
