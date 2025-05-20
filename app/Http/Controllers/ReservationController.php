<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Vehicule;
use App\Models\Agence;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Liste toutes les réservations.
     */
    public function index()
    {
        $reservations = Reservation::all();
        $trajets = Trajet::all();
        $vehicules = Vehicule::all();
        $agences = Agence::all();
        return view('reservations.index', compact('reservations', 'trajets', 'vehicules', 'agences'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        $trajets = Trajet::all();
        $vehicules = Vehicule::all();
        $agences = Agence::all();

        return view('reservations.create', compact('trajets', 'vehicules', 'agences'));
    }

    /**
     * Enregistre une nouvelle réservation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'nullable|email',
            'telephone' => 'required|string',
            'adresse' => 'nullable|string',
            'genre' => 'nullable|in:Homme,Femme,Autre',
            'date_reservation' => 'required|date',
            'vehicule_id' => 'required|exists:vehicules,id',
            'agence_id' => 'required|exists:agences,id',
            'trajet_id' => 'required|exists:trajets,id',
            'nombre_places' => 'required|integer|min:1',
        ]);

        $trajet = Trajet::findOrFail($request->trajet_id);
        $prix_total = $trajet->prix * $request->nombre_places;

        Reservation::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'genre' => $request->genre,
            'date_reservation' => $request->date_reservation,
            'vehicule_id' => $request->vehicule_id,
            'agence_id' => $request->agence_id,
            'trajet_id' => $request->trajet_id,
            'nombre_places' => $request->nombre_places,
            'prix_total' => $prix_total,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation enregistrée avec succès.');
    }

    /**
     * Affiche une réservation spécifique.
     */
    public function show($id)
    {
        $reservation = Reservation::with(['trajet', 'vehicule', 'agence'])->findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $trajets = Trajet::all();
        $vehicules = Vehicule::all();
        $agences = Agence::all();

        return view('reservations.edit', compact('reservation', 'trajets', 'vehicules', 'agences'));
    }

    /**
     * Mise à jour de la réservation.
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'nullable|email',
            'telephone' => 'required|string',
            'adresse' => 'nullable|string',
            'genre' => 'nullable|in:Homme,Femme,Autre',
            'date_reservation' => 'required|date',
            'vehicule_id' => 'required|exists:vehicules,id',
            'agence_id' => 'required|exists:agences,id',
            'trajet_id' => 'required|exists:trajets,id',
            'nombre_places' => 'required|integer|min:1',
            'statut' => 'nullable|in:en_attente,confirmee,annulee',
        ]);

        $trajet = Trajet::findOrFail($request->trajet_id);
        $prix_total = $trajet->prix * $request->nombre_places;

        $reservation->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'genre' => $request->genre,
            'date_reservation' => $request->date_reservation,
            'vehicule_id' => $request->vehicule_id,
            'agence_id' => $request->agence_id,
            'trajet_id' => $request->trajet_id,
            'nombre_places' => $request->nombre_places,
            'statut' => $request->statut,
            'prix_total' => $prix_total,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Supprime une réservation.
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,annulee',
        ]);

        $reservation->statut = $request->statut;
        $reservation->save();

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
}
