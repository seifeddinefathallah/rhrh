<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divers extends Model
{
    protected $fillable = ['type'];

    public const TYPES = [
        'intervention_requests' => 'Demandes d\'Interventions',
        'supply_requests' => 'Demandes de Fournitures',
        'material_requests' => 'Demandes de Matériels Informatiques',
        'specific_requests' => 'Autres Demandes Spécifiques',
    ];
}
