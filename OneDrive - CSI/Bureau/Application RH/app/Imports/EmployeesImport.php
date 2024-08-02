<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCreated;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class EmployeesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $emailParts = explode('@', $row['email_professionnel']);
        if (count($emailParts) != 2) {
            return null;
        }

        $nameUsername = explode('.', $emailParts[0]);
        $domain = $emailParts[1];

        $allowedDomains = ['csi-corporation.com', 'csi-maghreb.com', 'csi-international.com'];
        if (!in_array($domain, $allowedDomains)) {
            return null;
        }

        $name = $nameUsername[0];
        $username = $nameUsername[1];
        $defaultPassword = 'Csi@2019';

        $user = User::create([
            'name' => $name,
            'username' => $username,
            'email' => $row['email_professionnel'],
            'password' => Hash::make($defaultPassword),
            'created_at' => Carbon::now(),
        ]);

        Mail::to($row['email_professionnel'])->send(new EmployeeCreated($user, $defaultPassword));

        return new Employee([
            'user_id' => $user->id,
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'date_naissance' => Carbon::parse($row['date_naissance']),
            'email_professionnel' => $row['email_professionnel'],
            'email_personnel' => $row['email_personnel'],
            'matricule' => $row['matricule'],
            'telephone' => $row['telephone'],
            'adresse' => $row['adresse'],
            'code_postal' => $row['code_postal'],
            'ville' => $row['ville'],
            'pays' => $row['pays'],
            'situation_familiale' => $row['situation_familiale'],
            'nombre_enfants' => $row['nombre_enfants'],
        ]);
    }
}
