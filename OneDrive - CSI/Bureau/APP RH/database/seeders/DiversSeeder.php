<?php

namespace Database\Seeders;
use App\Models\Divers;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiversSeeder extends Seeder
{
    public function run()
    {
        $types = [
            'intervention_requests' => 'Demandes d\'Interventions',
            'supply_requests' => 'Demandes de Fournitures',
            'material_requests' => 'Demandes de Matériels Informatiques',
            'specific_requests' => 'Autres Demandes Spécifiques',
        ];

        foreach ($types as $type => $label) {
            Divers::updateOrCreate(
                ['type' => $type]
            );
        }
    }
}
