<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodDefinition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'days',
    ];

    public function temporaryBalances()
    {
        return $this->hasMany(TemporaryBalance::class);
    }
}
