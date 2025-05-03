<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    public function index()
    {
        $agences = Agence::all();
        return view('agences.index', compact('agences'));
    }

    public function create()
    {
        return view('agences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        Agence::create($request->all());

        return redirect()->route('agences.index')->with('success', 'Agence créée avec succès.');
    }

    public function show($id)
    {
        $agence = Agence::findOrFail($id);
        return view('agences.show', compact('agence'));
    }

    public function edit($id)
    {
        $agence = Agence::findOrFail($id);
        return view('agences.edit', compact('agence'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        $agence = Agence::findOrFail($id);
        $agence->update($request->all());

        return redirect()->route('agences.index')->with('success', 'Agence mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $agence = Agence::findOrFail($id);
        $agence->delete();

        return redirect()->route('agences.index')->with('success', 'Agence supprimée avec succès.');
    }
}
