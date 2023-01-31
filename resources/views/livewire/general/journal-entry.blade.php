<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Journal Entry') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Journal Entries</h5>
            <table class="table table-striped">
                <thead>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Encoder</th>
                    <th class="text-center align-middle">Description</th>
                    <th class="text-center align-middle">Date</th>
                    <th class="text-center align-middle">Action</th>
                </thead>
                <tbody>
                    @foreach ($journals as $index => $journal)
                        <td class="text-center align-middle">{{$index+1}}</td>
                        <td class="text-center align-middle">{{$journal->encoder}}</td>
                        <td class="text-center align-middle">{{$journal->description}}</td>
                        <td class="text-center align-middle">@date($journal->created_at)</td>
                        <td class="text-center align-middle">
                            <button class="btn btn-primary btn-sm" wire:click="loadModal({{$journal->id}})">View</button>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade modal-lg" id="entryModal" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Entry</h5> <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            @if ($journal_data)
                            <div class="mt-2 p-3">
                                <label>Journal ID: <b class="card-title">{{$journal_data->id}}</b></label><br>
                                <label>Encoder: <b class="card-title">{{$journal_data->encoder}}</b></label><br>
                                <label>Date: <b class="card-title">@date($journal_data->created_at)</b></label><br>
                                <label>Description: <b class="card-title">{{$journal_data->description}}</b></label>
                            </div>
                    
                            <table class="table table-bordered">
                                <thead>
                                    <th class="text-center align-middle">Account</th>
                                    <th class="text-center align-middle">Credit</th>
                                    <th class="text-center align-middle">Debit</th>
                                </thead>
                                <tbody>
                                    @foreach ($journal->entries as $entry)
                                    <tr>
                                        <td class="align-middle">{{$entry->account}}</td>
                                        <td class="align-middle">@money($entry->credit)</td>
                                        <td class="align-middle">@money($entry->debit)</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('open-modal',event=>{
            $('#entryModal').modal('show');
        });
    </script>
</div>
