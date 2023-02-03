<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Chart of Accounts') }}
        </h2>
    </x-slot>
    @isAdmin
    <button class="btn btn-sm btn-primary mb-3" data-bs-target="#newAccount" data-bs-toggle="modal">+ Add new
        account
    </button>
    @endisAdmin
   <div class="card">
    <div class="card-body">
        <h5 class="card-title">Accounts</h5>
            <div class="tab-pane fade show active" id="Assets" role="tabpanel" aria-labelledby="Assets-tab">
                <table class="table datatable table-sm">
                    <thead>
                        <th>Account No</th>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                        @isAdmin
                            <th class="text-center align-middle">Action</th>
                        @endisAdmin
                    </thead>
                    <tbody>
                        @foreach ($assets as $asset)
                        <tr>
                            <td>{{$asset->id}}</td>
                            <td>{{$asset->name}}</td>
                            <td>{{$asset->type}}</td>
                            <td>@money($asset->balance)</td>
                            @isAdmin
                            <td class="text-center align-middle">
                                <button class="btn btn-success btn-sm" wire:click="edit({{$asset->id}})">EDIT</button>
                            </td>
                            @endisAdmin
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        
    </div>
</div>
<x-breeze-modal id="newAccount" model="newAccount" wire:ignore>
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
            <div class="d-none" id="balance">
                <label>Balance</label>
                <input type="text" class="form-control" wire:model="balance">
                @error('balance') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </x-slot>
</x-breeze-modal>

<x-breeze-modal id="editModal" model="saveEdit" wire:ignore.self>
    <x-slot name="title">Edit</x-slot>
    <x-slot name="body">    
        @if ($chart)
            <label>Account Name</label>
            <input type="text" class="form-control" wire:model="name">
            <label>Balance</label>
            <input type="text" class="form-control" wire:model="balance">
        @endif
    </x-slot>
</x-breeze-modal>
<script>
    window.addEventListener('close-modal-account', event => {
    $('#newAccount').modal('hide')
    })
    window.addEventListener('open-modal', event => {
    $('#editModal').modal('show')
    })
    window.addEventListener('close-modal', event => {
    $('#editModal').modal('hide')
    })
    window.addEventListener('show-balance', event => {
        var x = document.getElementById('balance');
        x.classList.remove('d-none');
    })
</script>
</div>
