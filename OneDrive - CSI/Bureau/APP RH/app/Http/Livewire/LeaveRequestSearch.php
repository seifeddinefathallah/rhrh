<?php


namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LeaveRequest;

class LeaveRequestSearch extends Component
{
    public $search = '';

    public function render()
    {
        $leaveRequests = LeaveRequest::with('employee', 'leaveType')
            ->whereHas('employee', function($query) {
                $query->where('prenom', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('employee', function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('leaveType', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.leave-request-search', [
            'leaveRequests' => $leaveRequests
        ]);
    }
}

