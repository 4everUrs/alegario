<?php

namespace App\Http\Livewire\Bm;

use App\Models\Budget;
use Livewire\Component;

class History extends Component
{
    public function render()
    {
        return view('livewire.bm.history', [
            'histories' => Budget::all()
        ]);
    }
}
