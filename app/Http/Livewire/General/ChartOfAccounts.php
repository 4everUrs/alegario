<?php

namespace App\Http\Livewire\General;

use App\Models\Chart;
use Livewire\Component;

class ChartOfAccounts extends Component
{
    public $type, $name;
    protected $rules = [
        'type' => 'required',
        'name' => 'required|string'
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function render()
    {
        return view('livewire.general.chart-of-accounts', [
            'assets' => Chart::where('type', 'Asset')->get(),
            'liabilities' => Chart::where('type', 'Liabilities')->get(),
            'revenues' => Chart::where('type', 'Revenue')->get(),
            'expenses' => Chart::where('type', 'Expenses')->get(),
            'equities' => Chart::where('type', 'equity')->get(),
        ]);
    }

    public function newAccount()
    {
        $validatedData = $this->validate();
        Chart::create($validatedData);
        toastr()->addSuccess('Create account succesfully');

        $this->dispatchBrowserEvent('close-modal-account');
        $this->reset();
    }
}
