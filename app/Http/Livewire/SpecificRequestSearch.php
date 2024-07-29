<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SpecificRequest;

class SpecificRequestSearch extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $requests = SpecificRequest::whereHas('employee', function ($query) {
            $query->where('prenom', 'like', '%' . $this->search . '%')
                ->orWhere('nom', 'like', '%' . $this->search . '%');
        })->paginate(10);

        return view('livewire.specific-request-search', [
            'requests' => $requests,
        ]);
    }
}
