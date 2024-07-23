<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Departement;

class DepartementSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $departements = Departement::where('nom', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.departement-search', compact('departements'));
    }
}
