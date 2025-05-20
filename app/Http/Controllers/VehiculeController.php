<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Agence;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::with('agence')->get();
        $agences = Agence::all();
        return view('vehicules.index', compact('vehicules', 'agences'));
    }

    public function create()
    {
        $agences = Agence::all();
        return view('vehicules.create', compact('agences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'agence_id' => 'required|exists:agences,id',
            'numero_immatriculation' => 'required|string|unique:vehicules,numero_immatriculation',
            'type' => 'required|string',
            'nombre_places' => 'required|integer|min:1',
            'status' => 'required|in:plein,vide',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('vehicules', 'public');
        }

        Vehicule::create($validated);

        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté avec succès.');
    }

    public function show($id)
    {
        $vehicule = Vehicule::with('agence')->findOrFail($id);
        return view('vehicules.show', compact('vehicule'));
    }

    public function edit($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $agences = Agence::all();
        return view('vehicules.edit', compact('vehicule', 'agences'));
    }

    public function update(Request $request, $id)
    {
        $vehicule = Vehicule::findOrFail($id);

        $validated = $request->validate([
            'agence_id' => 'required|exists:agences,id',
            'numero_immatriculation' => 'required|string|unique:vehicules,numero_immatriculation,' . $vehicule->id,
            'type' => 'required|string',
            'nombre_places' => 'required|integer|min:1',
            'status' => 'required|in:plein,vide',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('vehicules', 'public');
        }

        $vehicule->update($validated);

        return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Vehicule::destroy($id);
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé.');
    }

    public function toggleStatus($id)
    {
        $vehicule = Vehicule::findOrFail($id);

        // Inverse le statut plein <-> vide
        $vehicule->status = ($vehicule->status === 'plein') ? 'vide' : 'plein';

        $vehicule->save();

        return redirect()->route('vehicules.index')->with('success', "Statut du véhicule mis à jour en '{$vehicule->status}'.");
    }
}
