@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Daily Care Record : ({{ $getRecord->total() }}) Total Recorded</h1> --}}
          <h1>Farm Daily Care Record</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('farm_daily_care.add') }}" class="btn btn-primary">Add New Care</a>
          
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
                <label>Search for Daily Care</label>
                <input type="text" class="form-control" name="name" placeholder="Search care name here" value="{{ Request::get('name') }}">
              </div>

              <div class="form-group col-md-3">
                {{-- <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button> --}}
                <a href="{{ route('farm_daily_care.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Daily Care List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Care Type</th>
                    <th>Quantity</th>
                    <th>House or Unit</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Picture</th>
                    <th>Recorded By</th>
                    <th>Recorded Date</th>
                    <th>Edited By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @include('admin.farm_daily_cares.partials.record_rows')


                </tbody>
              </table>

              <div style="padding: 10px; float: right;">
                {{-- {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }} --}}

                {{-- {{ $getRecord->links() }} --}}


                {{--
                  GO TO APPSERVICEPROVIDER AND ADD THE CODE BELOW FOR THIS PAGINATION TO WORK PROPERLY


                    public function boot(): void
                    {
                        paginator::useBootstrap();
                    }
                --}}
              </div>

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
                  url: "{{ route('farm_daily_care.ajax.search') }}",
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