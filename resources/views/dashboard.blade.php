<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="row">
    <div class="col">
       <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Customers <span>| This Month</span></h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                        class="bi bi-people"></i></div>
                <div class="ps-3">
                    <h6>0</h6> <span class="text-danger small pt-1 fw-bold">0%</span> <span
                        class="text-muted small pt-2 ps-1">decrease</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Revenue <span>| This Month</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                            class="bi bi-currency-dollar"></i></div>
                    <div class="ps-3">
                        <h6>₱. 0.00</h6> <span class="text-success small pt-1 fw-bold">0%</span> <span
                            class="text-muted small pt-2 ps-1">increase</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Revenue <span>| This Year</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i
                            class="bi bi-currency-dollar"></i></div>
                    <div class="ps-3">
                        <h6>₱. 0.00</h6> <span class="text-success small pt-1 fw-bold">0%</span> <span
                            class="text-muted small pt-2 ps-1">increase</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
   <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Revenue Chart</h5><canvas id="lineChart"
                    style="max-height: 400px; display: block; box-sizing: border-box; height: 221px; width: 442px;" width="442"
                    height="221"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                          new Chart(document.querySelector('#lineChart'), {
                            type: 'line',
                            data: {
                              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                              datasets: [{
                                label: 'Line Chart',
                                data: [65, 59, 80, 81, 56, 55, 40],
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                              }]
                            },
                            options: {
                              scales: {
                                y: {
                                  beginAtZero: true
                                }
                              }
                            }
                          });
                        });
                </script>
            </div>
        </div>
    </div>
    <div class="col">
       <div class="card">
        <div class="card-body">
            <h5 class="card-title">Patients</h5><canvas id="barChart"
                style="max-height: 400px; display: block; box-sizing: border-box; height: 221px; width: 442px;" width="442"
                height="221"></canvas>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#barChart'), {
                        type: 'bar',
                        data: {
                          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                          datasets: [{
                            label: 'Bar Chart',
                            data: [65, 59, 80, 81, 56, 55, 40],
                            backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgba(255, 205, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                              'rgb(255, 99, 132)',
                              'rgb(255, 159, 64)',
                              'rgb(255, 205, 86)',
                              'rgb(75, 192, 192)',
                              'rgb(54, 162, 235)',
                              'rgb(153, 102, 255)',
                              'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                          }]
                        },
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true
                            }
                          }
                        }
                      });
                    });
            </script>
        </div>
    </div>
    </div>
   </div>
</x-app-layout>