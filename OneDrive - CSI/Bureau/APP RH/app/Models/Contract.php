<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [

       'pays',
        'type',
        'classification',
        'coefficient',
        'periode_essai_initiale',
        'renouvellement',
        'debut_contrat',
        'duree_contrat',
        'fin_contrat' ,
        'employee_id',
    ];

    /**
     * Get the employee that owns the contract.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
