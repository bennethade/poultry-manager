@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Record</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- form start -->
              <form method="POST" action="{{ route('farm_record.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Activity Title<span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="activity_title" required placeholder="Activity Title" value="{{ old('activity_title') }}">
                            <div style="color: red;">{{ $errors->first('activity_title') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Activity Type</label>
                            <input type="text" class="form-control" name="activity_type" placeholder="Activity Type" value="{{ old('activity_type') }}">
                            <div style="color: red;">{{ $errors->first('activity_type') }}</div>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label>Gender <span style="color: red">*</span> </label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="">Select Gender</option> 
                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('gender') }}</div>
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label>Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="date" required value="{{ old('date') }}">
                            <div style="color: red;">{{ $errors->first('date') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Picture </label>
                            <input type="file" class="form-control" name="picture" >
                            <div style="color: red;">{{ $errors->first('picture') }}</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Note <span style="color: red"></span> </label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Add any extra notes">{{ old('notes') }}</textarea>
                            <div style="color: red;">{{ $errors->first('notes') }}</div>
                        </div>
                        
                        
                    </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
         
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

@endsection