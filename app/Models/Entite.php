<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'numero_fiscal',
        'adresse',
        'pays',
        'contact',
        'nom_employeur',
        'adresse_employeur',
        'numero_siret',
        'code_ape_naf',
        'convention_collective',
        'identifiant_etablissement',
        'image',
    ];
    public function departements()
    {
        return $this->belongsToMany(Departement::class, 'departement_entite', 'entite_id', 'departement_id');
    }

}
