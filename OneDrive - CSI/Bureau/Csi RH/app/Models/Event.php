<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_time', 'end_time', 'location', 'type', 'user_id'
    ];
    protected $dates = ['start_time', 'end_time'];

    // Example accessor
    public function getStartTimeAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public function getEndTimeAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'event_employee');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
