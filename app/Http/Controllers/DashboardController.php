<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicules = Vehicule::count();
        $totalTrajets = Trajet::count();
        $totalReservations = Reservation::count();
        $totalAgences = Agence::count();

        // Récupérer nombre réservations groupé par date
        $reservationsPerDay = Reservation::select(DB::raw('date_reservation as date'), DB::raw('count(*) as total'))
            ->groupBy('date_reservation')
            ->orderBy('date_reservation')
            ->get();

        // Formater les dates pour l'affichage (ex : 20 Mai)
        $labels = $reservationsPerDay->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        })->toArray();

        $data = $reservationsPerDay->pluck('total')->toArray();

        return view('dashboard', compact(
            'totalVehicules',
            'totalTrajets',
            'totalReservations',
            'totalAgences',
            'labels',
            'data'
        ));
    }
}
