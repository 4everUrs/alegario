<?php

namespace App\Http\Livewire\Ar;

use App\Models\Chart;
use App\Models\Entry;
use App\Models\JournalEntry;
use App\Models\Recievable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountsRecievable extends Component
{
    public $amount, $selected_id;
    public $installment, $type;
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
        $this->updateAccount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function createRecievable()
    {
        Recievable::create([
            'type' => $this->type,
            'amount' => $this->amount,
            'status' => 'Unpaid'
        ]);
        toastr()->addSuccess('Create Successfully');
        $this->dispatchBrowserEvent('close-modal-recievable');
    }
    public function updateAccount()
    {
        $cash = Chart::find('10003');
        $cash->balance = $cash->balance + $this->amount;
        $cash->save();

        $recievable = Chart::find('10001');
        $recievable->balance = $recievable->balance - $this->amount;
        $recievable->save();

        JournalEntry::create([
            'encoder' => Auth::user()->name,
            'description' => 'Recievable payment'
        ]);
        $journal = JournalEntry::latest()->first();
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Cash',
            'debit' => $this->amount,
        ]);
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Accounts Recievable',
            'credit' => $this->amount,
        ]);
    }
}
