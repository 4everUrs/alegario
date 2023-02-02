<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Collections') }}
        </h2>
    </x-slot>
    <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#invoicemodal" wire:click="addInvoice">+ Create Invoice</button>
    <div class="card" wire:ignore.self>
        <div class="card-body">
            <h5 class="card-title">Collections</h5>
            <table class="table datatable table-sm">
                <thead>
                    <th>Invoice No</th>
                    <th>Reciepient</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($collections as $index => $collection)
                        <tr>
                            <td>{{$collection->id}}</td>
                            <td>{{$collection->reciepient}}</td>
                            <td>{{$collection->status}}</td>
                            <td style="width: 50px " class="text-center"><a  wire:click="loadData({{$collection->id}})" data-bs-toggle="collapse" href="#collapseExample{{$index}}"
                                    class="bi bi-plus-square-fill"></a></td>
                        </tr>
                        <tr>
                            <td class="collapse" id="collapseExample{{$index}}" colspan="4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-3">
                                            <div class="action-buttons">
                                                <a class="btn btn-outline-success float-end" href="#" data-title="Print">
                                                    <i class="bi bi-printer-fill"></i>
                                                    Print
                                                </a>
                                                <a class="btn btn-outline-danger" href="#" data-title="PDF">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                    Export
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h5 class="card-title">Invoice No: <b class="text-danger">{{$collection->id}}</b></h5>
                                                <h5>To: <b>{{$collection->reciepient}}</b></h5>
                                                <h5> <i class="bi bi-map-fill"></i> {{$collection->address}}</h5>
                                                <h5><i class="bi bi-telephone-fill"></i> {{$collection->phone}}</h5>
                                            </div>
                                            <div class="col-md">
                                                <h5 class="card-title">Date Issued: <b class="text-danger">@date($collection->created_at)</b></h5>
                                                <h5>Institution: <b>Alegario Cure Medical</b></h5>
                                                <h5>Practioner: <b>{{$collection->Practitioner->name}}</b></h5>
                                                <h5>License No: <b>{{$collection->Practitioner->license}}</b></h5>
                                                <h5>Address: <b>{{$collection->Practitioner->address}}</b></h5>
                                                <h5>Phone: <b>{{$collection->Practitioner->phone}}</b></h5>
                                            </div>
                                        </div>
                                        @if ($cash_collection == 'cash')
                                            <div class="" id="cash-fields">
                                                <table class="table table-bordered">
                                                    <thead class="bg-info">
                                                        <th style="width: 20%" class="text-center align-middle">Payment Method</th>
                                                        <th class="text-center align-middle">Total Cost</th>
                                                        <th class="text-center align-middle">Status</th>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($cash_collection))
                                                        <tr>
                                                            <td class="text-center align-middle">{{$cash_collection}}</td>
                                                            <td class="text-center align-middle">@money($grandTotal)</td>
                                                            <td class="text-center align-middle"><span class="badge bg-success text-dark">Paid</span></td>
                                                        </tr>
                                                        @else
                                            
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        @if ($cash_collection == 'installment')
                                            <div class="">
                                                <table class="table">
                                                    <thead class="bg-info">
                                                        <th>Account No</th>
                                                        <th>Total Amount</th>
                                                        <th>Payment Type</th>
                                                        <th>Downpayment</th>
                                                        <th>Balance</th>
                                                        <th>Monthly Due</th>
                                                        <th>Paid Amount</th>
                                                        <th>Interest</th>
                                                        <th>Term</th>
                                                        <th>Status</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$installment_data->id}}</td>
                                                            <td>@money($installment_data->amount)</td>
                                                            <td>Installment</td>
                                                            <td>@money($installment_data->downpayment)</td>
                                                            <td>@money($installment_data->balance)</td>
                                                            <td>@money($installment_data->monthly_due)</td>
                                                            <td>@money($installment_data->paid_amount)</td>
                                                            <td>{{$installment_data->interest}} %</td>
                                                            <td>{{$installment_data->paid}}/{{$installment_data->terms}}</td>
                                                            @if ($installment_data->balance <= 0)
                                                                <td><span class="badge bg-success text-dark">Paid</span></td>
                                                            @else
                                                                <td><span class="badge bg-warning text-dark">Unpaid</span></td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        <table class="table table-bordered">
                                            <thead class="bg-info">
                                                <th class="text-center">No</th>
                                                <th class="text-center">Particulars</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Cost</th>
                                                <th class="text-center">Total</th>
                                            </thead>
                                            <tbody>
                                                @if (!empty($particulars))
                                                    @foreach ($particulars as $index => $particular)
                                                    <tr>
                                                        <td class="text-center">{{$index+1}}</td>
                                                        <td class="text-center">{{$particular->particular}}</td>
                                                        <td class="text-center">{{$particular->quantity}}</td>
                                                        <td class="text-center">@money($particular->cost)</td>
                                                        <td>@money($particular->total_cost)</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5"></td>
                                                    </tr>
                                                @endif
                                                <tr class="bg-secondary">
                                                    <td colspan="5"></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3"><b>Summary</b></td>
                                                    <td class="text-end">Sub-Total:</td>
                                                    <td>@money($subTotal)</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="text-end">Tax:</td>
                                                    <td>@money($tax)</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="text-end">Discount:</td>
                                                    <td>@money($collection->discount)</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="text-end">Grand Total:</td>
                                                    <td>@money($grandTotal)</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        <button class="btn btn-primary float-end">Pay now</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-breeze-modal id="invoicemodal" model="createInvoice" class="modal-lg" wire:ignore.self>
        <x-slot name="title">
            Create Invoice
        </x-slot>
        <x-slot name="body">
            <small><b class="text-danger">*</b> Field is required!</small>
            <div class="form-group">
                <label>Reciepient <b class="text-danger">*</b></label>
                <input wire:model="reciepient" type="text" class="form-control">
                @error('reciepient') <span class="text-danger">{{ $message }}</span> <br> @enderror
                <label>Address <b class="text-danger">*</b></label>
                <input wire:model="address" type="text" class="form-control">
                @error('address') <span class="text-danger">{{ $message }}</span> <br> @enderror
                <label>Phone <b class="text-danger">*</b></label>
                <input wire:model="phone" type="text" class="form-control">
                @error('phone') <span class="text-danger">{{ $message }}</span> <br> @enderror
                <label>Practitioner <b class="text-danger">*</b></label>
                <select class="form-select" wire:model="practitioner">
                    <option value="">Choose..</option>
                    @foreach ($practitioners as $practitioner)
                        <option value="{{$practitioner->id}}">{{$practitioner->name}}</option>
                    @endforeach
                </select>
                @error('practitioner') <span class="text-danger">{{ $message }}</span> <br> @enderror
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Particulars <b class="text-danger">*</b></label>
                            <input wire:model="particular" type="text" class="form-control">
                            @error('items') <span class="text-danger">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="col-2">
                            <label>Quantity <b class="text-danger">*</b></label>
                            <input wire:model="quantity" type="text" class="form-control">
                            @error('quantity') <span class="text-danger">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="col">
                            <label>Amount <b class="text-danger">*</b></label>
                            <input wire:model="amount" type="text" class="form-control">
                            @error('amount') <span class="text-danger">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="col-2">
                            <label></label>
                            <button class="btn btn-sm btn-danger form-control" wire:click="insertItem">Add Item</button>
                        </div>
                    </div>
                </div>
                <label>Payment Method <b class="text-danger">*</b></label>
                <select class="form-select" wire:model="payment_method">
                    <option value="">Choose..</option>
                    <option value="cash">Cash</option>
                    <option value="installment">Installment</option>
                    @error('payment_method') <span class="text-danger">{{ $message }}</span> <br> @enderror
                </select>
                <label>Discount (Optional)</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" wire:model="discount" placeholder="Optional">
                        <span class="input-group-text">.00</span>
                        
                    </div>
                <div class="form-group d-none" id="installmentFields">
                    <div class="row">
                        <div class="col">
                            <label>Terms</label>
                            <div class="input-group mb-3"> <input type="text" class="form-control" wire:model="terms">
                                <span class="input-group-text">month(s)</span>
                            </div>
                        </div>
                        <div class="col">
                            <label>Downpayment</label>
                            <div class="input-group mb-3"> 
                                <span class="input-group-text">$</span> 
                                <input type="text" class="form-control" wire:model="downpayment">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="col">
                            <label>Interest Rate</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model="interest">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table mt-4">
                    <thead class="bg-info">
                        <th class="text-center">No</th>
                        <th class="text-center">Particulars</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Cost</th>
                        <th class="text-center">Amount</th>
                    </thead>
                    <tbody>
                        @foreach ($items as $index  => $item)
                            <tr>
                                <td class="text-center">{{$index+1}}</td>
                                <td class="text-center">{{$item['particular']}}</td>
                                <td class="text-center">{{$item['quantity']}}</td>
                                <td class="text-center">{{$item['amount']}}</td>
                                <td class="text-center">{{$item['amount']*$item['quantity']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-secondary">
                            <td colspan="5"></td>
                        </tr>
                        <tr>
                            <td colspan="3">Summary</td>
                            <td>Sub-Total:</td>
                            <td>@money($subTotal)</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Tax:</td>
                            <td>@money($tax)</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Discount:</td>
                            <td>@money($discount)</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td><b>Grand Total:</b></td>
                            <td><b>@money($grandTotal)</b></td>
                        </tr>

                    </tfoot>
                </table>

            </div>
        </x-slot>
    </x-breeze-modal>
    <script>
       window.addEventListener('show-fields', event => {
            var x = document.getElementById('installmentFields');
            x.classList.remove('d-none');
        })
       window.addEventListener('close-modal', event => {
            $('#invoicemodal').modal('hide');
        })
       window.addEventListener('cash-fields', event => {
            var x = document.getElementById('cash-fields');
            x.classList.remove('d-none');
        })
    </script>
</div>
