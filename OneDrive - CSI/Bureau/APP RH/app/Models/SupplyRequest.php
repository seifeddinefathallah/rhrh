<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'item_name',
        'quantity',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
