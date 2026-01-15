@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>More Record for: <span style="color: brown">{{ $getFarmInventory->item_name }}</span></h5>
        </div>
        <div class="col-sm-6" style="text-align: right;">
            <h5>Quantity: <span style="color: brown">{{ $getFarmInventory->quantity }}</span></h5>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('farm_inventory.more_record.store', $getFarmInventory->id) }}" method="POST" class="breeding-form">
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
                        <!-- 🔽 YOUR EXISTING FORM FIELDS (UNCHANGED) -->

                        
                        {{-- <div class="form-group col-md-4">
                            <label>Breeding Type</label>
                            <select class="form-control" name="type">
                                <option value="Natural">Natural</option>
                                <option value="Artificial Insemination">Artificial Insemination</option>
                            </select>
                        </div>
                         --}}

                        <div class="form-group col-md-3">
                            <label>Date</label>
                            <input class="form-control" type="date" name="date">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Quantity Used</label>
                            <input class="form-control" type="text" name="quantity_used" placeholder="Today's usage">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Quantity Remaining</label>
                            <input class="form-control" type="text" name="quantity_remaining" placeholder="Total remaining">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Current State</label>
                            <input class="form-control" type="text" name="current_state" placeholder="State of item">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control" rows="2" name="remarks"  placeholder="Any additional notes"></textarea>
                        </div>

                        <div class="form-group col-md-12" style="">
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
                <h3 class="card-title mb-0">Record List</h3>
            </div>

            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Date</th>
                        <th>Quantity Used</th>
                        <th>Quantity Remaining</th>
                        <th>Current State</th>
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
                        // $id = ($getRecord->currentPage() - 1) * $getRecord->perPage() + 1;
                    @endphp

                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{ $id++ }}</td>
                            
                            <td style="min-width: 120px;">{{ date('d-m-Y', strtotime($value->date)) }}</td>
                            <td style="min-width: 150px;">{{ $value->quantity_used }}</td>
                            <td style="min-width: 150px;">{{ $value->quantity_remaining }}</td>
                            <td style="min-width: 200px;">{{ $value->current_state }}</td>

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
                                
                                <a href="{{ route('farm_inventory.more_record.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ url('admin/inventory/farm_inventory/more_record/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
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


    </script>


@endsection