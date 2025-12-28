@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Maintenance/Sanitation Record</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('maintenance_sanitation.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Date <span style="color: red">*</span></label>
                        <input class="form-control" type="date" name="date" required value="{{ old('date', $getRecord->date) }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Activity <span style="color: red">*</span></label>
                        <input class="form-control" type="text" name="activity" placeholder="Enter activity here" value="{{ old('activity', $getRecord->activity) }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Area</label>
                        <input class="form-control" type="text" name="area" placeholder="Enter area here" value="{{ old('area', $getRecord->area) }}">
                    </div>

                    <div class="form-group col-md-5">
                        <label>Chemicals Tools Used</label>
                        <input class="form-control" type="text" name="chemicals_tools_used" placeholder="Name of tools used" value="{{ old('chemicals_tools_used', $getRecord->chemicals_tools_used) }}">
                    </div>

                    {{-- <div class="form-group col-md-2">
                        <label>Time Of Day</label>
                        <select class="form-control" name="time_of_day" required>
                            <option value="">Select</option>
                            <option {{ old('time_of_day', $getRecord->time_of_day == 'Morning' ? 'selected' : '') }} value="Morning">Morning</option>
                            <option {{ old('time_of_day', $getRecord->time_of_day == 'Afternoon' ? 'selected' : '') }} value="Afternoon">Afternoon</option>
                            <option {{ old('time_of_day', $getRecord->time_of_day == 'Evening' ? 'selected' : '') }} value="Evening">Evening</option>
                        </select>
                    </div> --}}

                    <div class="form-group col-md-7">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="1" name="remarks" placeholder="Additional note">{{ old('remarks', $getRecord->remarks) }}</textarea>
                    </div>

                    <div class="form-group col-md-12" style="margin-top: 10px;">
                        <label></label>
                        <button class="form-control btn-primary" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </div>

        </form>
        
      </div>    

    </div>
  </section>




</div>




@endsection