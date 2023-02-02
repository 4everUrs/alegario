<?php

namespace App\Http\Livewire\General;

use App\Models\Chart;
use Livewire\Component;

class ChartOfAccounts extends Component
{
    public $type, $name, $balance;
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
        if ($this->type == 'Equity') {
            $this->dispatchBrowserEvent('show-balance');
        }
        return view('livewire.general.chart-of-accounts', [
            'assets' => Chart::all(),
        ]);
    }

    public function newAccount()
    {
        $validatedData = $this->validate();

        if ($this->type != 'Equity') {
            Chart::create($validatedData);
        } else {
            Chart::create([
                'type' => $this->type,
                'name' => $this->name,
                'balance' => $this->balance
            ]);
        }
        toastr()->addSuccess('Create account succesfully');

        $this->dispatchBrowserEvent('close-modal-account');
        $this->reset();
    }
}
