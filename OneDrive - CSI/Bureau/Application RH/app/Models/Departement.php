<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function entites()
    {
        return $this->belongsToMany(Entite::class, 'departement_entite', 'departement_id', 'entite_id');
    }
    public function postes()
    {
        return $this->hasMany(Poste::class);
    }
}
