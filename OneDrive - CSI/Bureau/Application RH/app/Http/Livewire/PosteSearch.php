<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Poste;

class PosteSearch extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function render()
    {
        $postes = Poste::query()
            ->where('titre', 'like', '%' . $this->searchTerm . '%')
            ->orWhereHas('departement', function ($query) {
                $query->where('nom', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate(10);

        return view('livewire.poste-search', [
            'postes' => $postes,
        ]);
    }
}
