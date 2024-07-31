<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartementEntite extends Model
{
    protected $table = 'departement_entite';

    // Définition des colonnes pouvant être remplies
    protected $fillable = [
        'entite_id', 'departement_id',
    ];
}
