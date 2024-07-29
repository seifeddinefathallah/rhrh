<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MaterialRequest;

class MaterialRequestSearch extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $requests = MaterialRequest::whereHas('employee', function ($query) {
            $query->where('prenom', 'like', '%' . $this->search . '%')
                ->orWhere('nom', 'like', '%' . $this->search . '%');
        })
            ->orWhere('material_name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.material-request-search', ['requests' => $requests]);
    }
}
