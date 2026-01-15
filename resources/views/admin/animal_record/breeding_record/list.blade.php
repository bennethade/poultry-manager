@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Breeding Record</h1>
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
        <form action="{{ route('breeding_record.store') }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                <h4 id="toggleBreedForm"
                    style="text-align: center; margin-bottom:10px; cursor:pointer;">
                    <b>
                        <i class="fa fa-plus-circle text-primary"></i>
                        Add New Breed
                    </b>
                </h4>

                @include('_message')
                
                
                <div id="breedFormBody" style="display:none;">
                    <div class="row">
                        <!-- 🔽 YOUR EXISTING FORM FIELDS (UNCHANGED) -->

                        <div class="form-group col-md-4">
                            <label>Sow</label>
                            <input type="text" class="form-control" list="sowList" placeholder="Select Sow ID" required>

                            <input type="hidden" name="sow_id" id="sow_id">

                            <datalist id="sowList">
                                @foreach($sows as $sow)
                                    <option value="{{ $sow->tag_id }}" data-id="{{ $sow->id }}"></option>
                                @endforeach
                            </datalist>

                        </div>

                        <div class="form-group col-md-4">
                            <label>Boar</label>
                            <input type="text" class="form-control" list="boarList" placeholder="Select Boar ID" required>

                            <input type="hidden" name="boar_id" id="boar_id">

                            <datalist id="boarList">
                                @foreach($boars as $boar)
                                    <option value="{{ $boar->tag_id }}" data-id="{{ $boar->id }}"></option>
                                @endforeach
                            </datalist>

                        </div>

                        
                        <div class="form-group col-md-4">
                            <label>Breeding Type</label>
                            <select class="form-control" name="type">
                                <option value="Natural">Natural</option>
                                <option value="Artificial Insemination">Artificial Insemination</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Expected Farrowing Date</label>
                            <input class="form-control" type="date" name="expected_farrow_date">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Actual Farrowing Date</label>
                            <input class="form-control" type="date" name="actual_farrow_date">
                        </div>

                        <div class="form-group col-md-3">
                            <label>No. Born Alive</label>
                            <input class="form-control" type="number" name="number_of_born_alive">
                        </div>

                        <div class="form-group col-md-3">
                            <label>No. of Stillborn</label>
                            <input class="form-control" type="number" name="number_of_stillborn">
                        </div>

                        <div class="form-group col-md-8">
                            <label>Remarks</label>
                            <textarea class="form-control" rows="1" name="remarks"></textarea>
                        </div>

                        <div class="form-group col-md-4" style="margin-top: 10px;">
                            <label></label>
                            <button class="form-control btn-primary" type="submit">
                                Save Record
                            </button>
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
                <h3 class="card-title mb-0">Breeding List</h3>

                <div style="width: 250px;">
                    <input type="text"
                        id="breedingSearch"
                        class="form-control form-control-sm"
                        placeholder="Search breeding records...">
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Breed ID</th>
                        <th>Sow ID</th>
                        <th>Boar ID</th>
                        <th>Type</th>
                        <th>Expected Farrow Date</th>
                        <th>Actual Farrow Date</th>
                        <th>Number Alive</th>
                        <th>Stillborn</th>
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
                            <td style="min-width: 150px;"><span class="badge badge-info">{{ $value->breed_id }}</span></td>
                            
                            <td style="min-width: 80px;"><span class="badge badge-primary">{{ $value->sow->tag_id }}</span></td>
                            <td style="min-width: 80px;"><span class="badge badge-secondary">{{ $value->boar->tag_id }}</span></td>
                            <td style="min-width: 120px;">{{ $value->type }}</td>
                            <td style="min-width: 120px;">{{ date('d-m-Y', strtotime($value->expected_farrow_date)) }}</td>
                            <td style="min-width: 120px;">{{ date('d-m-Y', strtotime($value->actual_farrow_date)) }}</td>
                            <td style="min-width: 100px;">{{ $value->number_of_born_alive }}</td>
                            <td style="min-width: 100px;">{{ $value->number_of_stillborn }}</td>

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
                                <a href="{{ route('breeding_record.more_record', [$value->id]) }}" class="btn btn-secondary btn-sm">More Record</a>
                                
                                <a href="{{ route('breeding_record.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ url('admin/animal_record/breeding_record/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
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


       // DEBOUNCE FUNCTION
      function debounce(callback, delay) {
          let timer;
          return function (...args) {
              clearTimeout(timer);
              timer = setTimeout(() => callback.apply(this, args), delay);
          };
      }


      //FOR DYNAMIC SEARCH
      $(document).ready(function () {
          $('input[name="name"]').on('keyup', debounce(function () {
              let query = $(this).val();

              $.ajax({
                  url: "{{ route('animal_identification.ajax.search') }}",
                  type: "GET",
                  data: { name: query },
                  success: function (response) {
                      $('table tbody').html(response.html);
                  }
              });
          }, 100));
      });



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
                    url: "{{ route('breeding_record.ajax.search') }}",
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
            if (e.target.getAttribute('list') === 'sowList') {
                let value = e.target.value;
                let option = document.querySelector(`#sowList option[value="${value}"]`);
                document.getElementById('sow_id').value = option ? option.dataset.id : '';
            }

            if (e.target.getAttribute('list') === 'boarList') {
                let value = e.target.value;
                let option = document.querySelector(`#boarList option[value="${value}"]`);
                document.getElementById('boar_id').value = option ? option.dataset.id : '';
            }

        });



    </script>


@endsection