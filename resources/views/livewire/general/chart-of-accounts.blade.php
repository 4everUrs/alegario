<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Chart of Accounts') }}
        </h2>
    </x-slot>
    <button class="btn btn-sm btn-primary mb-3" data-bs-target="#newAccount" data-bs-toggle="modal">+ Add new account</button>
   <div class="card">
    <div class="card-body">
        <h5 class="card-title">Accounts</h5>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li wire:ignore class="nav-item" role="presentation"> <button class="nav-link active" id="Assets-tab" data-bs-toggle="tab"
                    data-bs-target="#Assets" type="button" role="tab" aria-controls="Assets"
                    aria-selected="true">Assets</button></li>
            <li wire:ignore class="nav-item" role="presentation"> <button class="nav-link" id="Liabilities-tab" data-bs-toggle="tab"
                    data-bs-target="#Liabilities" type="button" role="tab" aria-controls="Liabilities" aria-selected="false"
                    tabindex="-1">Liabilities</button></li>
            <li wire:ignore class="nav-item" role="presentation"> <button class="nav-link" id="Equity-tab" data-bs-toggle="tab"
                    data-bs-target="#Equity" type="button" role="tab" aria-controls="Equity" aria-selected="false"
                    tabindex="-1">Equity</button></li>
            <li wire:ignore class="nav-item" role="presentation"> <button class="nav-link" id="Revenue-tab" data-bs-toggle="tab"
                    data-bs-target="#Revenue" type="button" role="tab" aria-controls="Revenue" aria-selected="false"
                    tabindex="-1">Revenue</button></li>
            <li wire:ignore class="nav-item" role="presentation"> <button class="nav-link" id="Expenses-tab" data-bs-toggle="tab"
                    data-bs-target="#Expenses" type="button" role="tab" aria-controls="Expenses" aria-selected="false"
                    tabindex="-1">Expenses</button></li>
        </ul>
        <div class="tab-content pt-2" id="myTabContent" >
            <div wire:ignore.self class="tab-pane fade show active" id="Assets" role="tabpanel" aria-labelledby="Assets-tab"> 
                <table class="table datatable table-sm">
                    <thead>
                        <th>Account No</th>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>
                        @foreach ($assets as $asset)
                            <tr>
                                <td>{{$asset->id}}</td>
                                <td>{{$asset->name}}</td>
                                <td>{{$asset->type}}</td>
                                <td>@money($asset->balance)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div wire:ignore.self class="tab-pane fade" id="Liabilities" role="tabpanel" aria-labelledby="Liabilities-tab"> 
                <table class="table datatable table-sm">
                    <thead>
                        <th>Account No</th>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>
                        @foreach ($liabilities as $liability)
                        <tr>
                            <td>{{$liability->id}}</td>
                            <td>{{$liability->name}}</td>
                            <td>{{$liability->type}}</td>
                            <td>@money($liability->balance)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div wire:ignore.self class="tab-pane fade" id="Equity" role="tabpanel" aria-labelledby="Equity-tab"> 
                <table class="table datatable table-sm">
                    <thead>
                        <th>Account No</th>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>
                        @foreach ($equities as $equity)
                        <tr>
                            <td>{{$equity->id}}</td>
                            <td>{{$equity->name}}</td>
                            <td>{{$equity->type}}</td>
                            <td>@money($equity->balance)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div wire:ignore.self class="tab-pane fade" id="Expenses" role="tabpanel" aria-labelledby="Equity-tab"> 
                <table class="table datatable table-sm">
                    <thead>
                        <th>Account No</th>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expenses)
                        <tr>
                            <td>{{$expenses->id}}</td>
                            <td>{{$expenses->name}}</td>
                            <td>{{$expenses->type}}</td>
                            <td>@money($expenses->balance)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div wire:ignore.self class="tab-pane fade" id="Revenue" role="tabpanel" aria-labelledby="Equity-tab"> 
                <table class="table datatable table-sm">
                    <thead>
                        <th>Account No</th>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>
                        @foreach ($revenues as $revenue)
                        <tr>
                            <td>{{$revenue->id}}</td>
                            <td>{{$revenue->name}}</td>
                            <td>{{$revenue->type}}</td>
                            <td>@money($revenue->balance)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-breeze-modal id="newAccount" model="newAccount" wire:ignore.self>
    <x-slot name="title">
        add new account
    </x-slot>

    <x-slot name="body">
        <div class="form-group">
            <label>Account Type</label>
            <select class="form-select" wire:model="type">
                <option value="">Choose..</option>
                <option value="Asset">Assets</option>
                <option value="Liabilities">Liabilities</option>
                <option value="Revenue">Revenue</option>
                <option value="Equity">Equity</option>
                <option value="Expenses">Expenses</option>
            </select>
            @error('type') <span class="text-danger">{{ $message }}</span><br> @enderror
            <label>Account Name</label>
            <input type="text" class="form-control" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </x-slot>
</x-breeze-modal>
<script>
    window.addEventListener('close-modal-account', event => {
    $('#newAccount').modal('hide')
    })
</script>
</div>
