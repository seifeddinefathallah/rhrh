<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'material_name',
        'description',
        'quantity',
        'status',
    ];

    // Define relationships, if any
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
