<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::select(
            'id',
            'nom',
            'prenom',
            'date_naissance',
            'email_professionnel',
            'email_personnel',
            'matricule',
            'telephone',
            'adresse',
            'code_postal',
            'ville',
            'pays',
            'situation_familiale',
            'nombre_enfants',
            'created_at'
        )->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Prénom',
            'Date de naissance',
            'Email professionnel',
            'Email personnel',
            'Matricule',
            'Téléphone',
            'Adresse',
            'Code postal',
            'Ville',
            'Pays',
            'Situation familiale',
            'Nombre d\'enfants',
            'Créé le'
        ];
    }
}
