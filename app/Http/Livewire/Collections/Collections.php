<?php

namespace App\Http\Livewire\Collections;

use App\Models\Chart;
use App\Models\Collection;
use App\Models\Installment;
use App\Models\Particular;
use App\Models\Practitioner;
use App\Models\Recievable;
use Livewire\Component;

class Collections extends Component
{
    public $items = [], $particular, $quantity, $amount, $payment_method;
    public $reciepient, $address, $phone, $practitioner, $totalAmount, $total;
    public $particulars, $subTotal, $tax, $discount = 0, $grandTotal, $cash_collection;
    public $terms, $downpayment;
    public $installment_data, $collection_data;

    protected $rules = [
        'reciepient' => 'required|min:3',
        'address' => 'required|min:3',
        'phone' => 'required|string|min:6',
        'payment_method' => 'required',
        'practitioner' => 'required',
        'items' => 'required',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function render()
    {
        $this->grandTotal = $this->total;
        $this->grandTotal = $this->grandTotal - $this->discount;
        if ($this->payment_method == 'installment') {
            $this->dispatchBrowserEvent('show-fields');
        }
        return view('livewire.collections.collections', [
            'practitioners' => Practitioner::all(),
            'collections' => Collection::with('Practitioner')->get(),
        ]);
    }
    public function loadData($id)
    {
        $this->reset();
        $collecion = Collection::find($id);

        $this->cash_collection = $collecion->payment_method;
        $this->particulars = Particular::where('collection_id', $id)->get();
        foreach ($this->particulars as $particular) {
            $this->subTotal += $particular->total_cost;
        }
        $this->tax = $this->subTotal * 0.12;
        $this->grandTotal = ($this->subTotal + $this->tax) - $collecion->discount;
        $this->total = $this->grandTotal;
        $this->installment_data = Installment::find($collecion->installment_id);
    }
    public function insertItem()
    {
        $this->items[] = [
            'particular' => $this->particular,
            'quantity' => $this->quantity,
            'amount' => $this->amount
        ];
        $this->subTotal += $this->amount * $this->quantity;
        $this->tax = $this->subTotal * 0.12;
        $this->grandTotal += ($this->subTotal + $this->tax) - $this->discount;
        $this->total = $this->grandTotal;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->particular = null;
        $this->quantity = null;
        $this->amount = null;
    }
    public function createInvoice()
    {
        $this->gettingAmount();
        $validatedData = $this->validate();
        $validatedData['practitioner_id'] = $this->practitioner;
        if ($this->payment_method == 'cash') {
            $status = 'Paid';
        } else {
            $status = 'Unpaid';
        }
        Collection::create([
            'reciepient' => $this->reciepient,
            'address' => $this->address,
            'phone' => $this->phone,
            'practitioner_id' => $this->practitioner,
            'payment_method' => $this->payment_method,
            'amount' => $this->totalAmount,
            'discount' => $this->discount,
            'status' => $status,
        ]);
        $this->insertParticulars();

        if ($this->payment_method == 'installment') {
            $this->setInstallment();
        }
        toastr()->addSuccess('Collection Added!');
        $this->dispatchBrowserEvent('close-modal');
        $this->reset();
    }
    public function gettingAmount()
    {
        foreach ($this->items as $item) {
            $this->totalAmount += $item['amount'] * $item['quantity'];
        }
    }
    public function insertParticulars()
    {
        foreach ($this->items as $item) {
            $collection_id  = Collection::latest('id')->first();
            Particular::create([
                'collection_id' => $collection_id->id,
                'particular' => $item['particular'],
                'quantity' => $item['quantity'],
                'cost' => $item['amount'],
                'total_cost' => $item['amount'] * $item['quantity'],
            ]);
        }
    }
    public function setInstallment()
    {
        $collecion = Collection::latest('id')->first();
        Recievable::create([
            'amount' => $this->totalAmount - $this->downpayment,
            'status' => 'Unpaid',
            'type' => 'Invoice'
        ]);
        $recievable = Recievable::latest('id')->first();
        Installment::create([
            'amount' => $this->totalAmount,
            'downpayment' => $this->downpayment,
            'terms' => $this->terms,
            'balance' => $this->totalAmount - $this->downpayment,
            'collection_id' => $collecion->id,
            'recievable_id' => $recievable->id
        ]);
        $installment = Installment::latest('id')->first();
        $collecion->installment_id = $installment->id;
        $collecion->save();
        Chart::find('10001')->update([
            'balance' =>    $this->totalAmount - $this->downpayment,
        ]);
        Chart::find('10003')->update([
            'balance' =>  $this->downpayment,
        ]);
    }
}
