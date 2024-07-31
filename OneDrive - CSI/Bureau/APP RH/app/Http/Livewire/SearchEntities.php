<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Entite;

class SearchEntities extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function render()
    {
        $entites = Entite::where('nom', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('numero_fiscal', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('adresse', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('contact', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.search-entities', ['entites' => $entites]);
    }
}
