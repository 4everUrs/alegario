<?php

namespace App\Http\Livewire\Disbursement;

use App\Models\disbursement\DisburseRequest;
use Livewire\Component;

class DisburseRequests extends Component
{
    public function render()
    {
        return view('livewire.disbursement.disburse-requests', [
            'requests' => DisburseRequest::all()
        ]);
    }
    // public function mount()
    // {
    //     $temp = DisburseRequest::with('BudgetRequests')->first();
    //     dd($temp);
    // }
}
