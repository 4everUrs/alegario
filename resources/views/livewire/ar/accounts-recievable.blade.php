<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Accounts Recievable') }}
        </h2>
    </x-slot>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRecievable">+ Create Recievables</button>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Recievables</h5>
            <table class="table datatable">
                <thead>
                    <th class="text-center align-middle">ID</th>
                    <th class="text-center align-middle">Type</th>
                    <th class="text-center align-middle">Date</th>
                    <th class="text-center align-middle">Amount</th>
                    <th class="text-center align-middle">Date of Completion</th>
                    <th class="text-center align-middle">Status</th>
                    <th class="text-center align-middle">Action</th>
                </thead>
                <tbody>
                    @foreach ($recievables as $recievable)
                        <tr>
                            <td class="text-center align-middle">{{$recievable->id}}</td>
                            <td class="text-center align-middle">{{$recievable->type}}</td>
                            <td class="text-center align-middle">@date($recievable->created_at)</td>
                            <td class="text-center align-middle">@money($recievable->amount)</td>
                            <td class="text-center align-middle">@date($recievable->created_at)</td>
                            <td class="text-center align-middle">{{$recievable->status}}</td>
                            <td class="text-center align-middle">
                                @if ($recievable->amount == 0)
                                    <button wire:click="pay_now({{$recievable->id}})" class="btn btn-secondary btn-sm" disabled>Paid</button>
                                @else
                                    <button wire:click="pay_now({{$recievable->id}})" class="btn btn-primary btn-sm">Pay Now</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-breeze-modal id="payNowModal" model="payNow" wire:ignore.self>
        <x-slot name="title">Pay now</x-slot>
        <x-slot name="body">
            <div class="form-group">
                <label>Amount</label>
                <input type="text" class="form-control" wire:model='amount'>
            </div>
        </x-slot>
    </x-breeze-modal>

    <x-breeze-modal id="createRecievable" model="createRecievable" wire:ignore.self>
        <x-slot name="title">Create Recievables</x-slot>
        <x-slot name="body">
            <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" wire:model='type'>
                <label>Amount</label>
                <input type="text" class="form-control" wire:model='amount'>
            </div>
        </x-slot>
    </x-breeze-modal>


    <script>
        window.addEventListener('show-modal', event=>{
            $('#payNowModal').modal('show');
        })
        window.addEventListener('close-modal', event=>{
            $('#payNowModal').modal('hide');
        })
        window.addEventListener('close-modal-recievable', event=>{
            $('#createRecievable').modal('hide');
        })
    </script>
</div>
