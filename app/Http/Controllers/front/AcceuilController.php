<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class AcceuilController extends Controller
{
    public function index()
    {

        $vehicules = Vehicule::all();
        return view('front.acceuil', compact('vehicules'));
    }
    public function show($id)
    {
        $vehicule = Vehicule::with('agence')->findOrFail($id);
        return view('front.vehicule-detail', compact('vehicule'));
    }
}
