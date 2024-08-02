<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SupplyRequest;

class SupplySearch extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function render()
    {
        $requests = SupplyRequest::with('employee')
            ->whereHas('employee', function ($query) {
                $query->where('nom', 'like', '%' . $this->search . '%')
                    ->orWhere('prenom', 'like', '%' . $this->search . '%');
            })

            ->paginate(10);

        return view('livewire.supply-search', [
            'requests' => $requests,
        ]);
    }
}

