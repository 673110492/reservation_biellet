<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicule;

class CartsController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::all(); // récupère tous les véhicules

        return view('front.cart', compact('vehicules')); // envoie les données à la vue
    }
}
