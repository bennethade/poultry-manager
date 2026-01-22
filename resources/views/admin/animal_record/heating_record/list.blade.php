@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Heating Record</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          {{-- <a href="{{ route('animal_identification.add') }}" class="btn btn-primary">Add New Animal</a> --}}
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('heating.store') }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                <h4 id="toggleBreedForm"
                    style="text-align: center; margin-bottom:10px; cursor:pointer;">
                    <b>
                        <i class="fa fa-plus-circle text-primary"></i>
                        Add Heating Record
                    </b>
                </h4>

                @include('_message')
                
                
                <div id="breedFormBody" style="display:none;">
                    <div class="row">
                        <!-- 🔽 YOUR EXISTING FORM FIELDS (UNCHANGED) -->

                        <div class="form-group col-md-2">
                            <label>Pig</label>
                            <input type="text" class="form-control" list="pigList" placeholder="Select Pig ID" required>

                            <input type="hidden" name="pig_id" id="pig_id">

                            <datalist id="pigList">
                                @foreach($pigs as $pig)
                                    <option value="{{ $pig->tag_id }}" data-id="{{ $pig->id }}"></option>
                                @endforeach
                            </datalist>

                        </div>

                        <div class="form-group col-md-3">
                            <label>Date</label>
                            <input class="form-control" type="date" name="date">
                        </div>
                        
                        <div class="form-group col-md-7">
                            <label>Measurement Detail</label>
                            <input class="form-control" type="text" name="measurement_detail" placeholder="Measurement info">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Observation</label>
                            <textarea class="form-control" rows="2" name="observation" placeholder="Clear observations"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Remarks</label>
                            <textarea class="form-control" rows="2" name="remarks" placeholder="Any additional info"></textarea>
                        </div>

                        <div class="form-group col-md-12" style="margin-top: 1px;">
                            <label></label>
                            <button class="form-control btn-primary" type="submit">
                                Save Record
                            </button>
                        </div>
                    </div>
                </div>

            </div>

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
                <h3 class="card-title mb-0">Heating List</h3>

                <div style="width: 250px;">
                    <input type="text"
                        id="breedingSearch"
                        class="form-control form-control-sm"
                        placeholder="Search records...">
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Pig ID</th>
                        <th>Date</th>
                        <th>Measurement Detail</th>
                        <th>Observation</th>
                        <th>Remark</th>
                        <th>Recorded By</th>
                        <th>Recorded Date</th>
                        <th>Edited By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                  
                    @php
                        use Illuminate\Support\Str;

                        $id = ($getRecord->currentPage() - 1) * $getRecord->perPage() + 1;
                    @endphp

                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{ $id++ }}</td>                            
                            <td style="min-width: 80px;"><span class="badge badge-info">{{ $value->pig?->tag_id }}</span></td>
                            <td style="min-width: 120px;">{{ date('d-m-Y', strtotime($value->date)) }}</td>
                            <td style="min-width: 100px;">{{ $value->measurement_detail }}</td>
                            <td style="min-width: 100px;">{{ $value->observation }}</td>

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
                                @if($value->staff)
                                    {{ $value->staff->name }}
                                    {{ $value->staff->last_name }}
                                    {{ $value->staff->other_name }}
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

                            <td style="min-width: 250px;">
                                <a href="{{ route('heating.more_record', [$value->id]) }}" class="btn btn-secondary btn-sm">More Record</a>
                                
                                <a href="{{ route('heating.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ url('admin/animal_record/heating/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
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
        </div>
        <!-- /.col -->
      </div>
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


       // DEBOUNCE FUNCTION
      function debounce(callback, delay) {
          let timer;
          return function (...args) {
              clearTimeout(timer);
              timer = setTimeout(() => callback.apply(this, args), delay);
          };
      }


      //FOR DYNAMIC SEARCH
      // $(document).ready(function () {
      //     $('input[name="name"]').on('keyup', debounce(function () {
      //         let query = $(this).val();

      //         $.ajax({
      //             url: "{{ route('heating.ajax.search') }}",
      //             type: "GET",
      //             data: { name: query },
      //             success: function (response) {
      //                 $('table tbody').html(response.html);
      //             }
      //         });
      //     }, 100));
      // });



       // TO TOGGLE BREED FORM (SHOW/HIDE)
        $(document).ready(function () {
            $('#toggleBreedForm').on('click', function () {
                $('#breedFormBody').slideToggle(300);

                // Toggle icon
                $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle');
            });
        });



        //FOR BREAD TABLE SEARCH
        $(document).ready(function () {

            $('#breedingSearch').on('keyup', debounce(function () {

                let query = $(this).val();

                $.ajax({
                    url: "{{ route('heating.ajax.search') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (html) {
                        $('table tbody').html(html);
                    }
                });

            }, 300));

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



        // SOW AND BOAR SEARCH
        document.addEventListener('input', function (e) {
            if (e.target.getAttribute('list') === 'pigList') {
                let value = e.target.value;
                let option = document.querySelector(`#pigList option[value="${value}"]`);
                document.getElementById('pig_id').value = option ? option.dataset.id : '';
            }

        });



    </script>


@endsection