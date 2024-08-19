<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'period',
        'sortie_balance',
        'teletravail_days_balance',
    ];

    // Si vous utilisez des relations avec l'employé
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
