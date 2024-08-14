<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory;
    use Notifiable;

    /**
     * Route notifications for the employee.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationFor($notification)
    {
        // Return the email address or other notification route for the employee
        return $this->email_professionnel;
    }
    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function entite()
    {
        return $this->belongsToMany(Entite::class, 'departement_entite', 'departement_id', 'entite_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contractType()
    {
        return $this->belongsTo(ContractType::class); // Assuming one-to-one relationship
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($employee) {
            $leaveTypes = LeaveType::all();

            foreach ($leaveTypes as $leaveType) {
                LeaveBalance::create([
                    'employee_id' => $employee->id,
                    'leave_type_id' => $leaveType->id,
                    'remaining_days' => $leaveType->max_days,
                ]);
            }
        });

        static::deleting(function ($employee) {
            if ($employee->user) {
                $employee->user->delete();
            }
        });
    }
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'date_naissance',
        'email_professionnel',
        'email_personnel',
        'matricule',
        'telephone',
        'code_postal',
        'ville',
        'pays',
        'adresse',
        'state',
        'situation_familiale',
        'nombre_enfants',
        'entite_id',
        'departement_id',
        'poste_id',
        'cin_numero',
        'cin_date_delivrance',
        'carte_sejour_numero',
        'carte_sejour_date_delivrance',
        'carte_sejour_date_expiration',
        'carte_sejour_type',
        'passeport_numero',
        'passeport_date_delivrance',
        'passeport_date_expiration',
        'passeport_delai_validite',
        'debut_contrat',
        'duree_contrat',
        'fin_contrat' ,
        'contract_type_id',
       'image',
        'sortie_balance',
        'teletravail_days_balance',

    ];
}

