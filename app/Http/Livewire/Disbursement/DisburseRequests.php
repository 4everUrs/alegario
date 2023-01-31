<?php

namespace App\Http\Livewire\Disbursement;

use App\Models\Budget;
use App\Models\BudgetRequest;
use App\Models\disbursement\DisburseRequest;
use Carbon\Carbon;
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
        $this->dispatchBrowserEvent('close-modal');
        toastr()->addSuccess('Operation Successfull');
        $this->reset();
    }
}
