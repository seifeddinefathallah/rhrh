<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'sortie_hours',
        'teletravail_days',
        'period_definition_id',
    ];

    // Définir la relation avec le modèle Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function periodDefinition()
    {
        return $this->belongsTo(PeriodDefinition::class);
    }
}

