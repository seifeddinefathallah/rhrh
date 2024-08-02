<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AuthorizationRequest;

class AuthorizationSearch extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $authorizations = AuthorizationRequest::query()
            ->where('type', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('status', 'like', '%' . $this->searchTerm . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.authorization-search', compact('authorizations'));
    }
}
