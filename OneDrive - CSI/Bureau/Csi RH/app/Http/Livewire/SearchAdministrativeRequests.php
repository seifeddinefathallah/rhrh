<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AdministrativeRequest;
use Livewire\WithPagination;

class SearchAdministrativeRequests extends Component
{
    use WithPagination;
    public $search = '';

    /*public function render()
    {
        $requests = AdministrativeRequest::query()
            ->where('type', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.search-administrative-requests', [
            'requests' => $requests,
        ]);
    }*/
    /*public function render()
    {
        $requests = AdministrativeRequest::query()
            ->join('employees', 'administrative_requests.employee_id', '=', 'employees.id')
            ->select('administrative_requests.*', 'employees.nom', 'employees.prenom')
            ->where('administrative_requests.type', 'like', '%' . $this->search . '%')
            ->orWhere('administrative_requests.status', 'like', '%' . $this->search . '%')
            ->orWhere('employees.nom', 'like', '%' . $this->search . '%')
            ->orWhere('employees.prenom', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.search-administrative-requests', [
            'requests' => $requests,
        ]);
    }*/
    public $searchTerm = '';
    protected $queryString = ['searchTerm'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $requests = AdministrativeRequest::whereHas('employee', function ($query) use ($searchTerm) {
            $query->where('nom', 'like', $searchTerm)
                ->orWhere('prenom', 'like', $searchTerm);
        })->paginate(10);

        return view('livewire.search-administrative-requests', [
            'requests' => $requests,
        ]);
    }
}
