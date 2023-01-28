<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('History') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Histories</h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation"> <button class="nav-link active" id="budget-tab" data-bs-toggle="tab"
                        data-bs-target="#budget" type="button" role="tab" aria-controls="budget"
                        aria-selected="true">Budget</button></li>
                <li class="nav-item" role="presentation"> <button class="nav-link" id="Requests-tab" data-bs-toggle="tab"
                        data-bs-target="#Requests" type="button" role="tab" aria-controls="Requests" aria-selected="false"
                        tabindex="-1">Requests</button></li>
                
            </ul>
            <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade active show" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                    <table class="table table-bordered table-responsive">
                            @foreach ($histories as $index => $history)
                                <tr>
                                    <td>{{$history->year}}</td>
                                    <td style="width: 50px " class="text-center"><a data-bs-toggle="collapse" href="#collapseExample{{$index}}"
                                            class="bi bi-plus-square-fill"></a></td>
                                </tr>
                           

                                <tr>
                                    <td class="collapse" id="collapseExample{{$index}}" colspan="2">
                                        <div class="card card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th class="text-center" colspan="2">{{$history->year}}</th>
                                                    
                                                </thead>
                                                <tr>
                                                    <td class="text-center" colspan="2">Encoded By: {{$history->encoded_by}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Operating</td>
                                                    <td style="width: 50%">@money($history->operating)</td>
                                                </tr>
                                                <tr>
                                                    <td>General</td>
                                                    <td style="width: 50%">@money($history->general)</td>
                                                </tr>
                                                <tr>
                                                    <td>Maintenance</td>
                                                    <td style="width: 50%">@money($history->maintenance)</td>
                                                </tr>
                                                <tr>
                                                    <td>Improvisation</td>
                                                    <td style="width: 50%">@money($history->improvisation)</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td style="width: 50%">@money($history->amount)</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                    
                </div>
                <div class="tab-pane fade" id="Requests" role="tabpanel" aria-labelledby="Requests-tab"> Nesciunt totam et.
                    Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat.
                    Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia
                    dolores. Ut laboriosam voluptatum dicta.</div>
            </div>
        </div>
    </div>
</div>
