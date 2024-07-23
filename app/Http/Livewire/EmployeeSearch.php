<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class EmployeeSearch extends Component
{
    use WithPagination;
    public $searchTerm = '';

    public function render()
    {
        $employees = Employee::when($this->searchTerm, function ($query) {
            $query->where('nom', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('prenom', 'like', '%' . $this->searchTerm . '%');
        })
            ->with('poste.departement.entites')
            ->paginate(10); // Paginate results (adjust the number as needed)

        return view('livewire.employee-search', [
            'employees' => $employees,
        ]);
    }

}
