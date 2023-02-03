<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Request List') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Disburse Budget</h5>
            <table class="table datatable">
                <thead>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Department</th>
                    <th class="text-center align-middle">Amount</th>
                    <th class="text-center align-middle">Description</th>
                    <th class="text-center align-middle">Date Request</th>
                    <th class="text-center align-middle">Date Approved</th>
                    <th class="text-center align-middle">Status</th>
                    <th class="text-center align-middle">Action</th>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td class="text-center align-middle">{{$request->id}}</td>
                            <td class="text-center align-middle">{{$request->BudgetRequests->department}}</td>
                            <td class="text-center align-middle">@money($request->BudgetRequests->amount)</td>
                            <td class="text-center align-middle">{{$request->BudgetRequests->description}}</td>
                            <td class="text-center align-middle">@date($request->created_at)</td>
                            @if (!empty($request->date_aproved))
                                <td class="text-center align-middle">@date($request->date_aproved)</td>
                            @else
                                <td class="text-center align-middle">--/--/----</td>
                            @endif
                            <td class="text-center align-middle">{{$request->status}}</td>
                            <td class="text-center align-middle">
                                @if ($request->status == 'Pending')
                                    <button class="btn btn-sm btn-primary" wire:click="disburse({{$request->id}})">Disburse</button>
                                @else
                                    <button class="btn btn-sm btn-secondary" wire:click="disburse({{$request->id}})" disabled>Disbursed</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-breeze-modal id="disburseModal" model="disburseBudget" wire:ignore.self>
        <x-slot name="title">Disbursement</x-slot>

        <x-slot name="body">
            
                <div class="form-group">
                    <label>Account</label>
                    <select class="form-select" wire:model="account">
                        <option value="">Choose...</option>
                        @if ($budget)
                        <option value="improvisation">Improvisation: @money($budget->improvisation)</option>
                        <option value="general">General Expenses: @money($budget->general)</option>
                        <option value="maintenance">Maintenance: @money($budget->maintenance)</option>
                        <option value="operating">Operating: @money($budget->operating)</option>
                        @endif
                    </select>
                    <label>Amount</label>
                    <input type="text" class="form-control" wire:model="amount">
                </div>
            
        </x-slot>
    </x-breeze-modal>

    <script>
        window.addEventListener('show-modal',event=>{
            $('#disburseModal').modal('show');
        })
        window.addEventListener('close-modal',event=>{
            $('#disburseModal').modal('hide');
        })
    </script>
</div>
