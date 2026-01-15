@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Event Management</h1>
            </div>
            <div class="col-sm-6" style="text-align: right;">
               <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
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
                     <div class="row mb-2">
                        <div class="col-md-5">
                            <input type="text" id="search_title" class="form-control" placeholder="Search here...">
                        </div>

                        <div class="col-md-4">
                            <select id="search_category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select id="search_status" class="form-control">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                            </select>
                        </div>

                        <div id="loading" class="text-center my-2" style="display:none;">
                            <i class="fas fa-spinner fa-spin"></i> Loading...
                        </div>
                    </div>

                </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>S/N</th>
                                 <th>Title</th>
                                 <th>Category</th>
                                 <th>Status</th>
                                 <th>Due Date</th>
                                 <th>Assigned To</th>
                                 <th>Priority</th>
                                 <th>Created Date</th>
                                 <th>Created By</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="taskTableBody">
                                @include('admin.tasks.partials.task_rows')
                            </tbody>

                        </table>
                     </div>
                  </div>
               </div>
               <!-- Pagination Links -->
               <div class="mt-2 px-3" style="float: right;">
                  {{ $tasks->links() }}
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

        <script>
            let typingTimer;
            const debounceDelay = 100; // milliseconds

            const titleInput = document.getElementById('search_title');
            const categorySelect = document.getElementById('search_category');
            const statusSelect = document.getElementById('search_status');

            titleInput.addEventListener('keyup', () => debounceSearch());
            categorySelect.addEventListener('change', () => fetchTasks());
            statusSelect.addEventListener('change', () => fetchTasks());

            function debounceSearch() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(fetchTasks, debounceDelay);
            }

            function fetchTasks() {
                document.getElementById('loading').style.display = 'block';
                let title = titleInput.value.trim();
                let category = categorySelect.value;
                let status = statusSelect.value;

                fetch("{{ route('tasks.search') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        title: title,
                        category_id: category,
                        status: status
                    })
                })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('taskTableBody').innerHTML = html;
                    document.getElementById('loading').style.display = 'none';
                })
                .catch(() => {
                    console.error('Search failed');
                });
            }

        </script>



   </section>
   <!-- /.content -->
</div>

@endsection


@section('script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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
    </script>

@endsection