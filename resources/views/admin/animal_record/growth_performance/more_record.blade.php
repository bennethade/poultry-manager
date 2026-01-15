@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>More Record for: <span class="badge badge-info">{{ $getGrowthRecord->pig->tag_id }}</span></h5>
        </div>
        <div class="col-sm-6" style="text-align: right;">
            <h5>Initial Weight: <span style="color: brown">{{ $getGrowthRecord->weight }}</span>(kg)</h5>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('growth_performance.more_record.store', $getGrowthRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                <h4 id="toggleBreedForm"
                    style="text-align: center; margin-bottom:10px; cursor:pointer;">
                    <b>
                        <i class="fa fa-plus-circle text-primary"></i>
                        Add Record
                    </b>
                </h4>

                @include('_message')
                
                
                <div id="breedFormBody" style="display:none;">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Measurement Date</label>
                            <input type="date" class="form-control" name="measurement_date" required>
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
                </div>

            </div>

            {{-- <button class="form-control" type="submit">Save Record</button> --}}
        </form>
        
      </div>    

    </div>
  </section>



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <!-- /.col -->
        <div class="col-md-12">

          {{-- @include('_message') --}}

          <!-- /.card -->

          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Record List</h3>
            </div>

            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
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
                <tbody>
                  
                  
                    @php
                        use Illuminate\Support\Str;

                        $id = 1;
                    @endphp

                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td style="min-width: 120px;">{{ date('d-m-Y', strtotime($value->measurement_date)) }}</td>
                            <td style="min-width: 100px;">{{ $value->age_in_days }}</td>
                            <td style="min-width: 100px;">{{ $value->age_in_weeks }}</td>
                            <td style="min-width: 100px;">{{ $value->weight }}</td>
                            <td style="min-width: 200px;">{{ $value->feed_type }}</td>

                            <td style="min-width: 300px;">
                                @php
                                    $fullText = $value->remarks;
                                    $shortText = Str::limit($fullText, 100);
                                @endphp

                                <span class="short-text">
                                    {{ $shortText }}
                                    @if (strlen($fullText) > 100)
                                        <a href="javascript:void(0)" class="read-more text-primary">[keep reading]</a>
                                    @endif
                                </span>

                                <span class="full-text d-none">
                                    {{ $fullText }}
                                    <a href="javascript:void(0)" class="read-less text-danger">[read less]</a>
                                </span>
                            </td>



                            <td style="min-width: 150px;">
                                @if($value->creator)
                                    {{ $value->creator->name }}
                                    {{ $value->creator->last_name }}
                                    {{ $value->creator->other_name }}
                                @endif
                            </td>

                            <td style="min-width: 150px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>

                            <td style="min-width: 150px;">
                                @if (!empty($value->editor))
                                    {{ $value->editor->name }} 
                                    {{ $value->editor->last_name }} 
                                    {{ $value->editor->other_name }}
                                @endif
                            </td>

                            <td style="min-width: 150px;">
                                
                                <a href="{{ route('growth_performance.more_record.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ url('admin/animal_record/growth_performance/more_record/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                                </form> 
                                
                            </td>
                        </tr>

                    @endforeach

                </tbody>
              </table>

            </div>
          </div>

          <!-- Pagination Links -->
          <div class="mt-2 px-3" style="float: right;">
              {{ $getRecord->links() }}
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


    <script>
        $(function() {
           $('.delete').on('click', function(e) {
               e.preventDefault();
               var form = $(this).closest('form');
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


        // FOR READ MORE AND READ LESS
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


        // TO TOGGLE BUTTON FORM (SHOW/HIDE)
        $(document).ready(function () {
            $('#toggleBreedForm').on('click', function () {
                $('#breedFormBody').slideToggle(300);

                // Toggle icon
                $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle');
            });
        });




       // DEBOUNCE FUNCTION
    //   function debounce(callback, delay) {
    //       let timer;
    //       return function (...args) {
    //           clearTimeout(timer);
    //           timer = setTimeout(() => callback.apply(this, args), delay);
    //       };
    //   }


      //FOR DYNAMIC SEARCH
    //   $(document).ready(function () {
    //       $('input[name="name"]').on('keyup', debounce(function () {
    //           let query = $(this).val();

    //           $.ajax({
    //               url: "{{ route('animal_identification.ajax.search') }}",
    //               type: "GET",
    //               data: { name: query },
    //               success: function (response) {
    //                   $('table tbody').html(response.html);
    //               }
    //           });
    //       }, 100));
    //   });



       


        //FOR BREAD TABLE SEARCH
        // $(document).ready(function () {

        //     $('#breedingSearch').on('keyup', debounce(function () {

        //         let query = $(this).val();

        //         $.ajax({
        //             url: "{{ route('breeding_record.ajax.search') }}",
        //             type: "GET",
        //             data: { query: query },
        //             success: function (html) {
        //                 $('table tbody').html(html);
        //             }
        //         });

        //     }, 300));

        // });



       



        // SOW AND BOAR SEARCH
        // document.addEventListener('input', function (e) {
        //     if (e.target.getAttribute('list') === 'sowList') {
        //         let value = e.target.value;
        //         let option = document.querySelector(`#sowList option[value="${value}"]`);
        //         document.getElementById('sow_id').value = option ? option.dataset.id : '';
        //     }

        //     if (e.target.getAttribute('list') === 'boarList') {
        //         let value = e.target.value;
        //         let option = document.querySelector(`#boarList option[value="${value}"]`);
        //         document.getElementById('boar_id').value = option ? option.dataset.id : '';
        //     }

        // });



    </script>


@endsection