@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Animal Identification: <span class="badge badge-secondary">{{ $getRecord->total() }}</span></h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('animal_identification.add') }}" class="btn btn-primary">Add New Animal</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">Search Teacher</h3>
        </div> --}}
        
        <form method="get" action=" ">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-9">
                <label>Search for an Animal</label>
                <input type="text" class="form-control" name="name" placeholder="Search here" value="{{ Request::get('name') }}">
              </div>

              <div class="form-group col-md-3">
                {{-- <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button> --}}
                <a href="{{ route('animal_identification.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
              </div>
              
            </div>
          </div>
          <!-- /.card-body -->
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

          @include('_message')

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Animal List</h3>

                <div class="text-center w-100">
                    <strong>Boar:</strong> {{ $boarCount }} &nbsp; | &nbsp;
                    <strong>Sow:</strong> {{ $sowCount }}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Tag ID</th>
                    <th>Breed</th>
                    <th>DOB</th>
                    <th>Sex</th>
                    <th>Stage</th>
                    <th>Source</th>
                    <th>Entery Date</th>
                    <th>Initial Weight</th>
                    <th>Current Weight</th>
                    <th>Production Stage</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Recorded By</th>
                    <th>Recorded Date</th>
                    <th>Edited By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @include('admin.animal_record.animal_identification.partials.record_rows')


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



    </script>


@endsection