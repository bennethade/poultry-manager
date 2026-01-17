@extends('layouts.app')

@section('content')
<div class="content-wrapper">
<section class="content-header d-flex justify-content-between">
    <h1>Medication & Treatment</h1>
    <a href="{{ route('medication_treatment.add') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> New Medication
    </a>
</section>

<section class="content">
<div class="container-fluid">

<div class="card shadow-sm">
    @include('_message')
    <div class="card-header d-flex justify-content-between">
        {{-- <h3 class="card-title">Medications</h3> --}}
        <input type="text" id="medicationSearch" class="form-control form-control-sm w-26" placeholder="🔍 Search here...">
    </div>

    <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Pig ID</th>
                    <th>Drug</th>
                    <th>Dosage</th>
                    <th>Duration</th>
                    <th>Next Due Date</th>
                    <th>Administered By</th>
                    <th>Remarks</th>
                    <th>Recorded By</th>
                    <th>Recorded Date</th>
                    <th>Edited By</th>
                    <th width="120">Action</th>
                </tr>
            </thead>
            <tbody id="medicationTableBody">
                @include('admin.disease_treatment.medication_treatment.partials.table_rows',['records'=>$getRecord])
            </tbody>
        </table>
    </div>
</div>

<div class="mt-2 float-end">
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

            function debounce(fn, delay = 300) {
                let timer;
                return function () {
                    let context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(() => fn.apply(context, args), delay);
                };
            }



            $('#medicationSearch').on('keyup', debounce(function () {
                $.get("{{ route('medication_treatment.ajax.search') }}", {
                    query: $(this).val()
                }, function (data) {
                    $('#medicationTableBody').html(data);
                });
            }, 100));



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

        });


        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('read-more')) {
                const td = e.target.closest('td');
                td.querySelector('.short-text').classList.add('d-none');
                td.querySelector('.full-text').classList.remove('d-none');
            }

            if (e.target.classList.contains('read-less')) {
                const td = e.target.closest('td');
                td.querySelector('.full-text').classList.add('d-none');
                td.querySelector('.short-text').classList.remove('d-none');
            }
        });
        
    </script>
@endsection

