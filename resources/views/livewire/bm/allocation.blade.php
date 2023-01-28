<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Budget Allocation') }}
        </h2>
    </x-slot>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basic"> Add Budget </button>
    <div class="row"> 
        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Budget <span>| Last Year</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                        class="bi bi-cash"></i></div>
                                <h6>@if (!empty($lastYear))
                                     @money($lastYear->amount)
                                @else
                                    <h6>P. 0.00</h6>
                                @endif</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Budget <span>| This Year</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                        class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>@if (!empty($thisYear))
                                        @money($thisYear->amount)
                                        @else
                                        <h6>P. 0.00</h6>
                                        @endif</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Operating <span>| This Year</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                        class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    @if (!empty($thisYear->operating))
                                        <h6>@money ($thisYear->operating)</h6>
                                    @else
                                        <h6>P. 0.00</h6>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col">
                        <div class="card info-card customer-card">
                            <div class="card-body">
                                <h5 class="card-title">Maintenance <span>| This Year</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                            class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        @if (!empty($thisYear->maintenance))
                                            <h6>@money ($thisYear->maintenance)</h6>
                                        @else
                                            <h6>P. 0.00</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="col">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Improvisation <span>| This Year</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                            class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        @if (!empty($thisYear->improvisation))
                                            <h6>@money ($thisYear->improvisation)</h6>
                                        @else
                                            <h6>P. 0.00</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">General Expenses <span>| This Year</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                                            class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        @if (!empty($thisYear->general))
                                            <h6>@money ($thisYear->general)</h6>
                                        @else
                                            <h6>P. 0.00</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Allocation</h5><canvas id="doughnutChart"
                        style="max-height: 400px; display: block; box-sizing: border-box; height: 400px; width: 442px;" width="442"
                        height="400"></canvas>
                    
                </div>
            </div>
        </div>
    </div>

    <x-breeze-modal model="testModal" id="basic" class="modal-lg" wire:ignore.self>
        <x-slot name="title">
            Add Budget
        </x-slot>

        <x-slot name="body">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="year">Year</label>
                        <select wire:model="year" name="year" class="form-select">
                            <option value="">Choose Option</option>
                            @for ($i = 2020; $i <2030 ; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        @error('year') <span class="text-danger">{{ $message }}</span> @enderror
                        
                    </div>
                    <div class="col">
                        <label for="name">Amount</label>
                        <div  class="input-group"> <span class="input-group-text">₱</span> <input type="number" wire:model="amount" class="form-control"
                                aria-label="Amount (to the nearest dollar)"> <span class="input-group-text">.00</span></div>
                                @if ($available < 0)
                                    <small class="float-end text-danger">Available:@money($available)</small>
                                @else
                                    <small class="float-end">Available:₱ {{$available}}.00</small>
                                @endif
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="name">Operating Budget</label>
                        <div class="input-group mb-3"> <span class="input-group-text">₱</span> <input wire:model="operating" type="number" class="form-control"
                                aria-label="Amount (to the nearest dollar)"> <span class="input-group-text">.00</span></div>
                                @error('operating') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col">
                        <label for="name">General Expenses</label>
                        <div class="input-group mb-3"> <span class="input-group-text">₱</span> <input wire:model="general" type="number" class="form-control"
                                aria-label="Amount (to the nearest dollar)"> <span class="input-group-text">.00</span></div>
                                @error('general') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="name">Maintenance</label>
                        <div class="input-group mb-3"> <span class="input-group-text">₱</span> <input wire:model="maintenance" type="number" class="form-control"
                                aria-label="Amount (to the nearest dollar)"> <span class="input-group-text">.00</span></div>
                                @error('maintenance') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col">
                        <label for="name">Improvisation</label>
                        <div class="input-group mb-3"> <span class="input-group-text">₱</span> <input wire:model="improvisation" type="number" class="form-control"
                                aria-label="Amount (to the nearest dollar)"> <span class="input-group-text">.00</span></div>
                                @error('improvisation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </x-slot>
    </x-breeze-modal>
 
       <script>
            window.addEventListener('close-modal', event => {
            $('#basic').modal('hide')
            })
            document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#doughnutChart'), {
            type: 'doughnut',
            data: {
            labels: [
            'Operating Budget',
            'Maintenance',
            'Improvisation',
            'General Expenses'
            ],
            datasets: [{
            label: 'My First Dataset',
            data: [60, 10, 10,20],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(255, 247, 98)'
            ],
            hoverOffset: 4
            }]
            }
            });
            });
        </script>
</div>
