<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorizationRequest extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'type',
        'start_date',
        'start_time',
        'end_date',
        'status',
        'duration_type', // Ajout du champ 'duration_type'
        'duration', // Ajout du champ 'duration'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
