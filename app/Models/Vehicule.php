<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function agence() { return $this->belongsTo(Agence::class); }
public function places() { return $this->hasMany(Place::class); }
public function trajets() { return $this->hasMany(Trajet::class); }

}
