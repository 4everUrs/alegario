<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Request List') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Title</h5>
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
                            @if (!empty($request->aproved_date))
                                <td class="text-center align-middle">@date($request->date_aproved)</td>
                            @else
                                <td class="text-center align-middle">--/--/----</td>
                            @endif
                            <td class="text-center align-middle">{{$request->status}}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-sm btn-primary">Disburse</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
