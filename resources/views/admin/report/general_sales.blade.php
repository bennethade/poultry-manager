@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📈 General Sales Report</h5>

                    <select id="yearSelector" class="form-select w-auto">
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="card-body">
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let chart;

function loadChart(year) {
    fetch(`{{ route('general.sales.report.data') }}?year=${year}`)
        .then(res => res.json())
        .then(data => {

            if (chart) {
                chart.destroy();
            }

            const ctx = document.getElementById('salesChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.months,
                    datasets: [
                        {
                            label: 'Total Sales',
                            data: data.total_sales,
                            backgroundColor: '#4CAF50'
                        },
                        {
                            label: 'Total Expense',
                            data: data.total_expense,
                            backgroundColor: '#F44336'
                        },
                        {
                            label: 'Gross Profit',
                            data: data.gross_profit,
                            backgroundColor: '#2196F3'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ₦' +
                                        Number(context.raw).toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => '₦' + value.toLocaleString()
                            }
                        }
                    }
                }
            });
        });
}

document.getElementById('yearSelector').addEventListener('change', function () {
    loadChart(this.value);
});

// Load default year
loadChart(document.getElementById('yearSelector').value);
</script>
@endsection
