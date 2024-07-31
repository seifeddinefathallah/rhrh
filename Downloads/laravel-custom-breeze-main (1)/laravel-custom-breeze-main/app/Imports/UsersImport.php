<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Extract the email parts
        $emailParts = explode('@', $row['email']);
        if (count($emailParts) != 2) {
            // Skip if the email is not valid
            return null;
        }

        $nameUsername = explode('.', $emailParts[0]);
        $domain = $emailParts[1];

        // Check if the domain is one of the allowed domains
        $allowedDomains = ['csi-corporation.com', 'csi-maghreb.com', 'csi-international.com'];
        if (!in_array($domain, $allowedDomains)) {
            // Skip this user if the domain is not allowed
            return null;
        }

        $name = isset($nameUsername[0]) ? $nameUsername[0] : null;
        $username = isset($nameUsername[1]) ? $nameUsername[1] : null;

        return new User([
            'name'       => $name,
            'username'   => $username,
            'email'      => $row['email'],
            'password'   => Hash::make('Csi@2019'),  // Set the default password here
            'created_at' => Carbon::now(),           // Set the created_at to current date and time
        ]);
    }
}
