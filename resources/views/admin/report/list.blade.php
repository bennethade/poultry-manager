@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Report</h1>
        </div>
                
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        
        
        <div class="card-body">
            <div style="position: relative; width: 100%; height: 300px;">
                <canvas id="reportBarChart"></canvas>
            </div>
        </div>


      </div>    

    </div>
  </section>



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <!-- /.col -->
        <div class="col-md-12">

          @include('_message')

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabular Representation</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              


              <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Period</th>
                        <th>Total Expense</th>
                        <th>Total Sales</th>
                        <th> <span style="color: blue">Profit</span> / <span style="color: red">Loss</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Today</strong></td>
                        <td>{{ number_format($today_expense, 2) }}</td>
                        <td>{{ number_format($today_sales, 2) }}</td>
                        <td>
                          @php
                            $todayBalance = $today_sales - $today_expense
                          @endphp
                            @if ($todayBalance >= $today_expense)
                                <span style="color: blue">{{ number_format($todayBalance, 2) }}</span>
                            @else
                                <span style="color: red">{{ number_format($todayBalance, 2) }}</span>
                              
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <td><strong>Yesterday</strong></td>
                        <td>{{ number_format($yesterday_expense, 2) }}</td>
                        <td>{{ number_format($yesterday_sales, 2) }}</td>
                        <td>
                            @php
                                $yesterdayBalance = $yesterday_sales - $yesterday_expense;
                            @endphp
                            <span style="color: {{ $yesterdayBalance >= 0 ? 'blue' : 'red' }}">
                                {{ number_format($yesterdayBalance, 2) }}
                            </span>
                        </td>
                    </tr>



                    <tr>
                        <td><strong>This Week</strong></td>
                        <td>{{ number_format($week_expense, 2) }}</td>
                        <td>{{ number_format($week_sales, 2) }}</td>
                        <td>
                            @php
                                $weekBalance = $week_sales - $week_expense;
                            @endphp
                            <span style="color: {{ $weekBalance >= 0 ? 'blue' : 'red' }}">
                                {{ number_format($weekBalance, 2) }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Last Week</strong></td>
                        <td>{{ number_format($last_week_expense, 2) }}</td>
                        <td>{{ number_format($last_week_sales, 2) }}</td>
                        <td>
                            @php
                                $lastWeekBalance = $last_week_sales - $last_week_expense;
                            @endphp
                            <span style="color: {{ $lastWeekBalance >= 0 ? 'blue' : 'red' }}">
                                {{ number_format($lastWeekBalance, 2) }}
                            </span>
                        </td>
                    </tr>



                    <tr>
                        <td><strong>This Month</strong></td>
                        <td>{{ number_format($month_expense, 2) }}</td>
                        <td>{{ number_format($month_sales, 2) }}</td>
                        <td>
                          @php
                            $thisMonthBalance = $month_sales - $month_expense
                          @endphp
                            @if ($thisMonthBalance >= $month_expense)
                                <span style="color: blue">{{ number_format($thisMonthBalance, 2) }}</span>
                            @else
                                <span style="color: red">{{ number_format($thisMonthBalance, 2) }}</span>                              
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Last Month</strong></td>
                        <td>{{ number_format($last_month_expense, 2) }}</td>
                        <td>{{ number_format($last_month_sales, 2) }}</td>
                        <td>
                          @php
                            $lastMmonthBalance = $last_month_sales - $last_month_expense
                          @endphp
                            @if ($lastMmonthBalance >= $last_month_expense)
                                <span style="color: blue">{{ number_format($lastMmonthBalance, 2) }}</span>
                            @else
                                <span style="color: red">{{ number_format($lastMmonthBalance, 2) }}</span>                              
                            @endif
                        </td>
                    </tr>

                    <tr class="bg-light">
                        <td><strong>All Time</strong></td>
                        <td>{{ number_format($total_expense, 2) }}</td>
                        <td>{{ number_format($total_sales, 2) }}</td>
                        <td>
                          @php
                            $allTimeBalance = $total_sales - $total_expense;
                          @endphp
                            <span style="color: {{ $allTimeBalance >= 0 ? 'blue' : 'red' }}">
                                {{ number_format($allTimeBalance, 2) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>



            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>



@endsection


@section('script')

<!--For SweetAlert2 Library-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    const ctx = document.getElementById('reportBarChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Today',
                'Yesterday',
                'This Week',
                'Last Week',
                'This Month',
                'Last Month',
                'All Time'
            ],
            datasets: [
                {
                    label: 'Sales',
                    data: [
                        {{ $today_sales }},
                        {{ $yesterday_sales }},
                        {{ $week_sales }},
                        {{ $last_week_sales }},
                        {{ $month_sales }},
                        {{ $last_month_sales }},
                        {{ $total_sales }}
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)'
                },
                {
                    label: 'Expense',
                    data: [
                        {{ $today_expense }},
                        {{ $yesterday_expense }},
                        {{ $week_expense }},
                        {{ $last_week_expense }},
                        {{ $month_expense }},
                        {{ $last_month_expense }},
                        {{ $total_expense }}
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.8)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // 🔥 THIS FIXES MOBILE
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        font: {
                            size: 10
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Sales vs Expense Report',
                    font: {
                        size: 14
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 30,
                        font: {
                            size: 10
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                }
            }
        }

    });
</script>







@endsection