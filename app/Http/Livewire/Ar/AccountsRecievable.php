<?php

namespace App\Http\Livewire\Ar;

use App\Models\Recievable;
use Livewire\Component;

class AccountsRecievable extends Component
{
    public $amount, $selected_id;
    public function render()
    {
        return view('livewire.ar.accounts-recievable', [
            'recievables' => Recievable::all()
        ]);
    }
    public function pay_now($id)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->selected_id = $id;
    }
    public function payNow()
    {
        $recievable = Recievable::find($this->selected_id);
        if ($recievable->amount == $this->amount) {
            $recievable->status = 'Paid';
            $recievable->save();
        }
        $recievable->amount = $recievable->amount - $this->amount;
        $recievable->save();
        $this->dispatchBrowserEvent('close-modal');
    }
}
