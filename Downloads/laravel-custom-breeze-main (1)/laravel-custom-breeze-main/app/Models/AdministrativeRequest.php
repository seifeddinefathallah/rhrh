<?php
// app/Models/AdministrativeRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'type',
        'status',
    ];

    public const TYPES = [
        'Attestation de travail',
        'Attestation de salaire',
        'Fiche de paie avec cachet',
        'Domiciliation de Salaire',
        'Remboursement de Frais',
        'Frais de mission',
        'Remboursement astreinte',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
