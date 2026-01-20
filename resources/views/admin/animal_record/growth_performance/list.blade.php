@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>Growth Performance</h1>
        </section>

        <section class="content">
            <div class="container-fluid">

            <!-- 🔍 Pig Selector -->
                <div class="card">
                    <div class="card-body">

                        @include('_message')
                        
                        <label><strong>Select Pig</strong></label>
                        <input type="text"
                            class="form-control"
                            list="pigList"
                            placeholder="Search Pig Tag ID">
                        {{-- <input type="hidden" name="pig_id" id="pig_id"> --}}

                        <datalist id="pigList">
                            @foreach($pigs as $pig)
                                <option value="{{ $pig->tag_id }}" data-id="{{ $pig->id }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

            <!-- ➕ Add Growth Record -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 id="toggleGrowthForm" style="cursor:pointer">
                            <i class="fa fa-plus-circle text-primary"></i> Add Growth Record
                        </h5>
                    </div>

                    <div class="card-body" id="growthFormBody" style="display:none">
                        <form method="POST" action="{{ route('growth_performance.store') }}">
                            @csrf

                            <input type="hidden" name="pig_id" id="form_pig_id">

                            <div class="row">
                                <div class="col-md-3">
                                    <label>Measurement Date</label>
                                    <input type="date" class="form-control" name="measurement_date">
                                </div>

                                <div class="col-md-3">
                                    <label>Age (Days)</label>
                                    <input type="number" class="form-control" name="age_in_days" placeholder="Age in days">
                                </div>

                                <div class="col-md-3">
                                    <label>Age (Weeks)</label>
                                    <input type="number" class="form-control" name="age_in_weeks" placeholder="Age in weeks">
                                </div>

                                <div class="col-md-3">
                                    <label>Weight (kg)</label>
                                    <input type="number" class="form-control" name="weight" step="any" placeholder="Eg: 12.5">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label>Feed Type</label>
                                    <input type="text" class="form-control" name="feed_type" placeholder="Feed type">
                                </div>

                                <div class="col-md-8 mt-2">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="remarks" rows="1" placeholder="Any additional notes"></textarea>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary">Save Record</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                
                </div>

            <!-- 📊 Growth Chart -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Growth Chart</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="growthChart" height="120"></canvas>
                    </div>
                </div>

                <!-- 📋 Records Table -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Growth Records</h5>
                    </div>

                    <div class="card-body p-0">
                        <div style="overflow-x:auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Tag ID</th>
                                        <th>Measurement Date</th>
                                        <th>Age in Days</th>
                                        <th>Age in Weeks</th>
                                        <th>Weight (kg)</th>
                                        <th>Feed Type</th>
                                        <th>Remarks</th>
                                        <th>Recorded By</th>
                                        <th>Recorded Date</th>
                                        <th>Edited By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="growthTable">
                                    @php 
                                        $id = ($records->currentPage() - 1) * $records->perPage() + 1;
                                    @endphp

                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td style="min-width: 100px;">{{ $record->pig?->tag_id }}</td>
                                            <td style="min-width: 120px;">{{ $record->measurement_date }}</td>
                                            <td style="min-width: 100px;">{{ $record->age_in_days }}</td>
                                            <td style="min-width: 100px;">{{ $record->age_in_weeks }}</td>
                                            <td style="min-width: 100px;">{{ $record->weight }}</td>
                                            <td style="min-width: 200px;">{{ $record->feed_type }}</td>
                                            <td style="min-width: 250px;">{{ $record->remarks }}</td>
                                            <td style="min-width: 150px;">{{ $record->staff?->name }} {{ $record->staff?->last_name }}</td>
                                            <td style="min-width: 100px;">{{ $record->created_at }}</td>
                                            <td style="min-width: 150px;">{{ $record->editor?->name }} {{ $record->editor?->last_name }}</td>
                                            <td style="min-width: 250px;">                                        
                                                <a href="{{ route('growth_performance.more_record', [$record->id]) }}" class="btn btn-secondary btn-sm">More Record</a>
                                                <a href="{{ route('growth_performance.edit', [$record->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ url('admin/animal_record/growth_performance/delete/'.$record->id) }}" method="POST" class="d-inline-block delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Links -->
                        <div class="mt-2 px-3" style="float: right">
                            {{ $records->links() }}
                        </div>
                        
                    </div>

                </div>

            </div>
        </section>
    </div>


@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {

            let chart;

            function renderChart(labels, data) {
                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(document.getElementById('growthChart'), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Weight (kg)',
                            data: data,
                            tension: 0.4,
                            fill: true
                        }]
                    }
                });
            }

            // Pig selector
            $('input[list="pigList"]').on('input', function () {
                let tag = $(this).val();
                let option = $('#pigList option').filter(function () {
                    return this.value === tag;
                });

                let pigId = option.data('id');
                $('#form_pig_id').val(pigId);

                if (!pigId) return;

                $.get("{{ url('admin/animal_record/growth_performance') }}/" + pigId, function (res) {
                    renderChart(res.chartDates, res.chartWeights);
                    $('#growthTable').html(res.table);
                });
            });

            // Toggle growth form
            $('#toggleGrowthForm').on('click', function () {
                let pigId = $('#form_pig_id').val();
                if (!pigId) {
                    alert('Please select a pig first');
                    return;
                }

                $('#growthFormBody').slideToggle(300);
                $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle');
            });



            // Delete button (delegation)
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete this record?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });


        });

    </script>

@endsection

