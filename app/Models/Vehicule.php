<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    public function places()
    {
        return $this->hasMany(Place::class);
    }
    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


    public function verifierStatut()
    {
        $this->loadSum('reservations', 'nombre_places');

        if ($this->reservations_sum_nombre_places >= $this->nombre_places) {
            $this->status = 'plein';
        } else {
            $this->status = 'vide';
        }

        $this->save();
    }
}
