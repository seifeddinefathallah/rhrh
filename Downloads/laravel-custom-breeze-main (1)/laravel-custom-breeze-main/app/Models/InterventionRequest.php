<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'description',
        'request_date',
        'status',
    ];
    protected $casts = [
        'request_date' => 'datetime', // This will ensure it's treated as a Carbon instance
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
