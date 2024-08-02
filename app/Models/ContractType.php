<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{ 
    
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'country', 'classification', 'coefficient', 'probation_period', 'renouvellement', 'cdt_renouv'
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
