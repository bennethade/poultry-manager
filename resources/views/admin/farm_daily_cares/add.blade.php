@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Daily Care</h1>
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
              <form method="POST" action="{{ route('farm_daily_care.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Care Type<span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="care_type" required placeholder="Eg: Feeding, Watering, ..." value="{{ old('care_type') }}">
                            <div style="color: red;">{{ $errors->first('care_type') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="Quantity of activity" value="{{ old('quantity') }}">
                            <div style="color: red;">{{ $errors->first('quantity') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>House_or Unit</label>
                            <input type="text" class="form-control" name="house_or_unit" placeholder="Detail of the location" value="{{ old('house_or_unit') }}">
                            <div style="color: red;">{{ $errors->first('house_or_unit') }}</div>
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

                        <div class="form-group col-md-4">
                            <label>Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="date" required value="{{ old('date') }}">
                            <div style="color: red;">{{ $errors->first('date') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Picture </label>
                            <input type="file" class="form-control" name="picture" >
                            <div style="color: red;">{{ $errors->first('picture') }}</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Activity Detail <span style="color: red">*</span> </label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Add details of activity" required>{{ old('notes') }}</textarea>
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