@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Heating Record</h1>
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
        <form action="{{ route('staff.heating.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Pig</label>
                        <select class="form-control" name="pig_id" required>
                            <option value="">Select Sow</option>
                            @foreach($pigs as $pig)
                                <option {{ old('pig_id',$getRecord->pig_id == $pig->id) ? 'selected' : ''  }} value="{{ $pig->id }}">{{ $pig->tag_id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="date" value="{{ old('date', $getRecord->date) }}">
                    </div>
                    
                    <div class="form-group col-md-7">
                        <label>Measurement Detail</label>
                        <input class="form-control" type="text" name="measurement_detail" placeholder="Measurement info" value="{{ old('measurement_detail', $getRecord->measurement_detail) }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Observation</label>
                        <textarea class="form-control" rows="2" name="observation" placeholder="Clear observations">{{ old('observation', $getRecord->observation) }}</textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="2" name="remarks" placeholder="Any additional info">{{ old('remarks', $getRecord->remarks) }}</textarea>
                    </div>


                    <div class="form-group col-md-12" style="margin-top: 1px;">
                        <label></label>
                        <button class="form-control btn-primary" type="submit">Update Record</button>
                    </div>
                </div>
            </div>

        </form>
        
      </div>    

    </div>
  </section>




</div>




@endsection