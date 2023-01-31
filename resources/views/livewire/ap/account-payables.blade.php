<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Payables') }}
        </h2>
    </x-slot>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPayable">+ Create Payable</button>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Payables</h5>
            <table class="table datatable">
                <thead>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Type</th>
                    <th class="text-center align-middle">Description</th>
                    <th class="text-center align-middle">Date</th>
                    <th class="text-center align-middle">Amount</th>
                    <th class="text-center align-middle">Date of Completion</th>
                    <th class="text-center align-middle">Status</th>
                    <th class="text-center align-middle">Action</th>
                </thead>
                <tbody>
                    @foreach ($payables as $index => $payable)
                        <tr>
                            <td class="text-center align-middle">{{$index+1}}</td>
                            <td class="text-center align-middle">{{$payable->type}}</td>
                            <td class="text-center align-middle">{{$payable->description}}</td>
                            <td class="text-center align-middle">@date($payable->created_at)</td>
                            <td class="text-center align-middle">@money($payable->amount)</td>
                            @if (!empty($payable->completion))
                                <td class="text-center align-middle">@date($payable->completion)</td>
                            @else
                                <td class="text-center align-middle">{{'--/--/--'}}</td>
                            @endif
                            
                            <td class="text-center align-middle">{{$payable->status}}</td>
                            <td class="text-center align-middle">
                                @if ($payable->amount == 0)
                                    <button class="btn btn-secondary btn-sm" wire:click="pay({{$payable->id}})" disabled>Paid</button>
                                @else
                                    <button class="btn btn-primary btn-sm" wire:click="pay({{$payable->id}})">Pay Now</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <x-breeze-modal id="createPayable" model="createPayable" wire:ignore.self>
        <x-slot name="title">Create Recievables</x-slot>
        <x-slot name="body">
            <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" wire:model='type'>
                <label>Description</label>
                <textarea rows="3" class="form-control" wire:model="description"></textarea>
                <label>Amount</label>
                <input type="text" class="form-control" wire:model='amount'>
            </div>
        </x-slot>
    </x-breeze-modal>

    <x-breeze-modal id="payNow" model="payNow" wire:ignore.self>
        <x-slot name="title">Create Recievables</x-slot>
        <x-slot name="body">
            <div class="form-group">
                <label>Amount</label>
                <input type="text" class="form-control" wire:model='amount'>
                
            </div>
        </x-slot>
    </x-breeze-modal>

    <script>
        window.addEventListener('close-modal',event=>{
            $('#createPayable').modal('hide');
        });
        window.addEventListener('close-modal-paynow',event=>{
            $('#payNow').modal('hide');
        });
        window.addEventListener('open-modal',event=>{
            $('#payNow').modal('show');
        });
    </script>
</div>
