<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContractType;

class ContractTypeSearch extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function render()
    {
        $contractTypes = ContractType::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                     ;
            })
            ->paginate(10);

        return view('livewire.contract-type-search', [
            'contractTypes' => $contractTypes,
        ]);
    }
}
