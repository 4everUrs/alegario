<?php

namespace App\Http\Livewire\Ap;

use App\Models\Chart;
use App\Models\Entry;
use App\Models\JournalEntry;
use App\Models\Payable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountPayables extends Component
{
    public $type, $description, $amount, $payable_id;

    protected $rules = [
        'type' => 'required|min:3',
        'description' => 'required|min:3',
        'amount' => 'required|integer'
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function render()
    {
        return view('livewire.ap.account-payables', [
            'payables' => Payable::orderBy('id', 'desc')->get(),
        ]);
    }
    public function mount()
    {
        $payables = Payable::where('status', 'Unpaid')->get();
        foreach ($payables as $payable) {
            if ($payable->amount == 0) {
                $payable->status = 'Paid';
                $payable->completion = Carbon::parse(now())->toFormattedDateString();
                $payable->save();
            };
        }
    }
    public function createPayable()
    {
        $validatedData = $this->validate();
        Payable::create($validatedData);
        $payable = Chart::find('10002');
        $payable->balance = $payable->balance + $this->amount;
        $payable->save();
        toastr()->addSuccess('Create Successfull');
        $this->dispatchBrowserEvent('close-modal');
        $this->reset();
    }
    public function pay($id)
    {
        $this->dispatchBrowserEvent('open-modal');
        $this->payable_id = $id;
    }
    public function payNow()
    {
        $payable = Payable::find($this->payable_id);
        $payable->amount = $payable->amount - $this->amount;
        $payable->save();
        $this->createJournal();
        $chart = Chart::find('10002');
        $chart->balance = $chart->balance - $this->amount;
        $chart->save();
        toastr()->addSuccess('Payment Successfull');
        $this->dispatchBrowserEvent('close-modal-paynow');
        $this->reset();
    }

    public function createJournal()
    {
        JournalEntry::create([
            'encoder' => Auth::user()->name,
            'description' => 'Payable payment'
        ]);
        $journal = JournalEntry::latest()->first();
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Cash',
            'debit' => $this->amount,
        ]);
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Accounts Payable',
            'credit' => $this->amount,
        ]);
    }
}
