<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LoanRequest;

class LoanRequestSearch extends Component
{
    public $search = '';

    public function render()
    {
        // Query for loan requests based on the employee's name or surname
        $loanRequests = LoanRequest::query()
            ->join('employees', 'loan_requests.employee_id', '=', 'employees.id')
            ->where(function($query) {
                $query->where('employees.nom', 'like', '%' . $this->search . '%')
                    ->orWhere('employees.prenom', 'like', '%' . $this->search . '%');
            })
            ->select('loan_requests.*')
            ->get();

        return view('livewire.loan-request-search', compact('loanRequests'));
    }
}
