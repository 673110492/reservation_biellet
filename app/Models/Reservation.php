<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'genre',
        'date_reservation',
        'statut',
        'vehicule_id',
        'agence_id',
        'trajet_id',
        'nombre_places',
        'prix_total',
    ];



    // 🚗 Relation avec le véhicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    // 🏢 Relation avec l’agence
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    // 📍 Relation avec le trajet
    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    // 🔁 Hook pour calculer automatiquement le prix total
    protected static function booted()
    {
        static::creating(function ($reservation) {
            if ($reservation->trajet && $reservation->nombre_places) {
                $reservation->prix_total = $reservation->trajet->prix * $reservation->nombre_places;
            }
        });
    }
}
