@extends('layouts.app')

@section('content')
<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Vaccine Schedule</h1>
        <a href="{{ route('vaccine_schedule.add') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> New Schedule
        </a>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<div class="card shadow-sm">
    
    @include('_message')

    <div class="card-header d-flex justify-content-between align-items-center">
        {{-- <h3 class="card-title mb-0">Incidence List</h3> --}}
        <input type="text" id="vaccineSearch" class="form-control form-control-sm w-30" placeholder="🔍 Search here...">
    </div>

    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>S/N</th>
                    <th>Pig ID</th>
                    <th>Vaccine Name</th>
                    <th>Age Given</th>
                    <th>Date Given</th>
                    <th>Next Due Date</th>
                    <th>Administered By</th>
                    <th>Remarks</th>
                    <th>Recorded By</th>
                    <th>Recorded Date</th>
                    <th>Edited By</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="incidenceTableBody">
                @include('admin.vaccine_record.vaccine_schedule.partials.table_rows', ['records' => $getRecord])
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 float-end">
    {{ $getRecord->links() }}
</div>

</div>
</section>
</div>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    // DEBOUNCE (NORMAL FUNCTION, NOT ARROW)
    function debounce(func, delay = 300) {
        let timer;
        return function () {
            let context = this;
            let args = arguments;

            clearTimeout(timer);
            timer = setTimeout(function () {
                func.apply(context, args);
            }, delay);
        };
    }

    // SEARCH
    $('#vaccineSearch').on('keyup', debounce(function () {

        let query = $(this).val(); // ✅ this now works

        $.ajax({
            url: "{{ route('vaccine_schedule.ajax.search') }}",
            type: "GET",
            data: { query: query },
            success: function (data) {
                $('#incidenceTableBody').html(data);
            }
        });

    }, 400));

    // DELETE CONFIRMATION
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Delete Record?',
            text: 'This action cannot be undone',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });

    // READ MORE / LESS
    $(document).on('click', '.read-more', function () {
        let td = $(this).closest('td');
        td.find('.short-text').addClass('d-none');
        td.find('.full-text').removeClass('d-none');
    });

    $(document).on('click', '.read-less', function () {
        let td = $(this).closest('td');
        td.find('.full-text').addClass('d-none');
        td.find('.short-text').removeClass('d-none');
    });

});
</script>
@endsection

