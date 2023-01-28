<?php

namespace App\Http\Livewire\Ar;

use App\Models\Recievable;
use Livewire\Component;

class AccountsRecievable extends Component
{
    public $amount, $selected_id;
    public $installment;
    public function render()
    {
        return view('livewire.ar.accounts-recievable', [
            'recievables' => Recievable::all()
        ]);
    }
    // public function mount()
    // {
    //     $temp = Recievable::with('Installment')->latest()->first();
    //     dd($temp->Installment->id);
    // }
    public function pay_now($id)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->selected_id = $id;
        $this->installment = Recievable::find($id);
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
        $this->installment->Installment->balance  = $this->installment->Installment->balance - $this->amount;
        $this->installment->Installment->paid = $this->installment->Installment->paid + 1;
        $this->installment->Installment->save();
        if ($this->installment->Installment->paid == $this->installment->Installment->terms) {
            $this->installment->Installment->status = 'Paid';
            $this->installment->Installment->save();
        }
        $this->dispatchBrowserEvent('close-modal');
    }
}
