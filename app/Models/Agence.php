<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'telephone'];


    public function utilisateurs() { return $this->hasMany(User::class); }
public function vehicules() { return $this->hasMany(Vehicule::class); }

}
