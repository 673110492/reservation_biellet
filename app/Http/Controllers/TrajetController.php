<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    /**
     * Afficher la liste des trajets.
     */
    public function index()
    {
        // On charge aussi le véhicule lié pour éviter les requêtes N+1
        $trajets = Trajet::all();
        $vehicules = Vehicule::all();
        return view('trajets.index', compact('trajets','vehicules'));
    }

    /**
     * Afficher le formulaire de création d'un trajet.
     */
    public function create()
    {
        $vehicules = Vehicule::all();
        return view('trajets.create', compact('vehicules'));
    }

    /**
     * Enregistrer un nouveau trajet.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'duree' => 'required', // format HH:MM:SS
            'distance_km' => 'nullable|numeric|min:0',
            'date_heure_depart' => 'nullable|date',
        ]);

        Trajet::create($request->all());

        return redirect()->route('trajets.index')->with('success', 'Trajet ajouté avec succès.');
    }

    /**
     * Afficher un trajet spécifique.
     */
    public function show(Trajet $trajet)
    {
        $trajet->load('vehicule');
        return view('trajets.show', compact('trajet'));
    }

    /**
     * Afficher le formulaire d'édition d'un trajet.
     */
    public function edit(Trajet $trajet)
    {
        $vehicules = Vehicule::all();
        return view('trajets.edit', compact('trajet', 'vehicules'));
    }

    /**
     * Mettre à jour un trajet existant.
     */
    public function update(Request $request, Trajet $trajet)
    {
        $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'duree' => 'required',
            'distance_km' => 'nullable|numeric|min:0',
            'date_heure_depart' => 'nullable|date',
        ]);

        $trajet->update($request->all());

        return redirect()->route('trajets.index')->with('success', 'Trajet mis à jour avec succès.');
    }

    /**
     * Supprimer un trajet.
     */
    public function destroy(Trajet $trajet)
    {
        $trajet->delete();

        return redirect()->route('trajets.index')->with('success', 'Trajet supprimé avec succès.');
    }
}
