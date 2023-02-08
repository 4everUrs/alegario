<?php

namespace App\Http\Livewire\Disbursement;

use App\Models\Budget;
use App\Models\BudgetRequest;
use App\Models\Chart;
use App\Models\disbursement\DisburseRequest;
use App\Models\Entry;
use App\Models\JournalEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DisburseRequests extends Component
{
    public $selected_id, $amount, $account, $thisYearBudget;
    public function render()
    {
        $this->thisYearBudget = Carbon::parse(now())->format('Y');
        return view('livewire.disbursement.disburse-requests', [
            'requests' => DisburseRequest::all(),
            'budget' => Budget::where('year', $this->thisYearBudget)->first(),
        ]);
    }
    // public function mount()
    // {
    //     $temp = DisburseRequest::with('BudgetRequests')->first();
    //     dd($temp);
    // }
    public function disburse($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('show-modal');
    }
    public function disburseBudget()
    {
        $data = DisburseRequest::find($this->selected_id);
        $data->approve_amount = $this->amount;
        $data->status = 'Disbursed';
        $data->date_aproved = Carbon::parse(now())->toFormattedDateString();
        $data->save();

        $request = BudgetRequest::find($data->budget_requests_id);
        $request->approved_amount = $this->amount;
        $request->status = 'Disbursed';
        $request->save();

        $budget = Budget::where('year', $this->thisYearBudget)->first();
        if ($this->account == 'improvisation') {
            $budget->improvisation = $budget->improvisation - $this->amount;
            $budget->save();
        } elseif ($this->account == 'general') {
            $budget->general = $budget->general - $this->amount;
            $budget->save();
        } elseif ($this->account == 'operating') {
            $budget->operating = $budget->operating - $this->amount;
            $budget->save();
        } elseif ($this->account == 'maintenance') {
            $budget->maintenance = $budget->maintenance - $this->amount;
            $budget->save();
        }
        $this->creatJournal();
        $this->dispatchBrowserEvent('close-modal');
        toastr()->addSuccess('Operation Successfull');
        $this->reset();
    }
    public function creatJournal()
    {
        JournalEntry::create([
            'encoder' => Auth::user()->name,
            'description' => 'Budget Disbursement'
        ]);
        $journal = JournalEntry::latest()->first();
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Expenses',
            'debit' => $this->amount,
        ]);
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Cash',
            'credit' => $this->amount,
        ]);
        $expenses = Chart::find('10006');
        $expenses->balance = $expenses->balance + $this->amount;
        $expenses->save();
        $cash = Chart::find('10003');
        $cash->balance = $cash->balance - $this->amount;
        $cash->save();
    }
}
