@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">📊 General Expense Report</h5>

                        <select id="yearSelector" class="form-select w-auto">
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-body">
                        <canvas id="expenseChart" height="120"></canvas>
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
    fetch(`{{ route('general.expense.report.data') }}?year=${year}`)
        .then(res => res.json())
        .then(data => {

            if (chart) {
                chart.destroy();
            }

            const ctx = document.getElementById('expenseChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.months,
                    datasets: [
                        {
                            label: 'Opening Balance',
                            data: data.opening,
                            backgroundColor: '#4CAF50'
                        },
                        {
                            label: 'Total Spent',
                            data: data.spent,
                            backgroundColor: '#F44336'
                        },
                        {
                            label: 'Closing Balance',
                            data: data.closing,
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

// Load default year on page load
loadChart(document.getElementById('yearSelector').value);
</script>
@endsection
