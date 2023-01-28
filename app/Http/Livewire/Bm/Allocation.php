<?php

namespace App\Http\Livewire\Bm;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Allocation extends Component
{
    public $year, $amount, $general = 0, $maintenance = 0, $improvisation = 0, $operating = 0, $available = 0, $encoded_by;
    public $thisYearBudget, $lastYearBudget;
    protected $rules = [
        'year' => 'required',
        'amount' => 'required|int|min:0',
        'general' => 'required|int|min:0',
        'maintenance' => 'required|int|min:0',
        'improvisation' => 'required|int|min:0',
        'operating' => 'required|int|min:0',
        'encoded_by' => 'required'

    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function render()
    {
        $this->available = $this->amount;
        $this->available -= $this->general;
        $this->available -= $this->maintenance;
        $this->available -= $this->improvisation;
        $this->available -= $this->operating;
        $this->encoded_by = Auth::user()->name;
        $this->thisYearBudget = Carbon::parse(now())->format('Y');
        $this->lastYearBudget = Carbon::parse(now())->subYear()->format('Y');
        return view('livewire.bm.allocation', [
            'thisYear' => Budget::where('year', $this->thisYearBudget)->first(),
            'lastYear' => Budget::where('year', $this->lastYearBudget)->first()

        ]);
    }

    public function testModal()
    {
        try {
            $validatedData = $this->validate();
            if ($this->available >= 0) {
                Budget::create($validatedData);
                toastr()->addSuccess('Save Successfully');
                $this->dispatchBrowserEvent('close-modal');
            } else {
                toastr()->addError('Operation Failed');
            }
        } catch (\Exception $e) {
            toastr()->addError('Operation Failed');
        }
    }
}
