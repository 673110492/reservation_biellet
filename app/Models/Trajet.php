<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    public function vehicule() { return $this->belongsTo(Vehicule::class); }
public function stationDepart() { return $this->belongsTo(Station::class, 'station_depart_id'); }
public function stationArrivee() { return $this->belongsTo(Station::class, 'station_arrivee_id'); }
public function horaires() { return $this->hasMany(Horaire::class); }

}
