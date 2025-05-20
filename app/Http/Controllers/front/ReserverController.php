<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Agence;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class ReserverController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        $trajets = Trajet::all();
        $vehicules = Vehicule::all();
        $agences = Agence::all();
        return view('front.reservation', compact('reservations', 'trajets', 'vehicules', 'agences'));
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'genre' => 'nullable|in:Homme,Femme,Autre',
            'date_reservation' => 'required|date|after_or_equal:today',
            'vehicule_id' => 'required|exists:vehicules,id',
            'agence_id' => 'required|exists:agences,id',
            'trajet_id' => 'required|exists:trajets,id',
            'nombre_places' => 'required|integer|min:1',
            'prix_total' => 'nullable|numeric|min:0',
        ]);

        // ✅ Vérification du nombre de places disponibles
        $vehicule = Vehicule::findOrFail($validated['vehicule_id']);
        $placesReservees = Reservation::where('vehicule_id', $vehicule->id)->sum('nombre_places');
        $placesRestantes = $vehicule->nombre_places - $placesReservees;

        if ($validated['nombre_places'] > $placesRestantes) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Le véhicule sélectionné est plein ou n'a plus assez de places disponibles. Veuillez en choisir un autre.");
        }

        // ✅ Création de la réservation
        $reservation = Reservation::create($validated);

        // ✅ Redirection vers la page de fiche avec impression automatique
        return redirect()->route('reservation.print', $reservation->id);
    }

    public function print($id)
    {
        $reservation = Reservation::with(['vehicule', 'agence', 'trajet'])->findOrFail($id);
        return view('front.reservation_print', compact('reservation'));
    }
}
