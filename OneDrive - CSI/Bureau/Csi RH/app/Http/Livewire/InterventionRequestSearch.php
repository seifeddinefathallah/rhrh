<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InterventionRequest;
use Illuminate\Support\Facades\DB;

class InterventionRequestSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function render()
    {
        $requests = InterventionRequest::query()
            ->when($this->search, function ($query) {
                $query->whereHas('employee', function ($query) {
                    $query->where(DB::raw("CONCAT(nom, ' ', prenom)"), 'like', "%{$this->search}%");
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.intervention-request-search', [
            'requests' => $requests,
        ]);
    }
}
