@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Animal</h1>
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
              <form method="POST" action="{{ route('animal_identification.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">

                      <div class="form-group col-md-3">
                            <label>Source <span style="color: red">*</span> </label>
                            <select name="source" id="" class="form-control" required>
                                <option value="">Select Source</option> 
                                <option {{ (old('source') == 'Born') ? 'selected' : '' }} value="Born">Born</option> 
                                <option {{ (old('source') == 'Purchased') ? 'selected' : '' }} value="Purchased">Purchased</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('source') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Date of Birth<span style="color: red"></span> </label>
                            <input type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                            <div style="color: red;">{{ $errors->first('dob') }}</div>
                        </div>

                        
                        <div class="form-group col-md-3">
                          <label>Sex <span style="color: red">*</span> </label>
                          <select name="sex" id="" class="form-control" required>
                            <option value="">Select Sex</option> 
                            <option {{ (old('sex') == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                            <option {{ (old('sex') == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                          </select>
                          <div style="color: red;">{{ $errors->first('sex') }}</div>
                        </div>
                        
                        
                        <div class="form-group col-md-3">
                            <label>Entry Date<span style="color: red"></span> </label>
                            <input type="date" class="form-control" name="date_entry" value="{{ old('date_entry') }}">
                            <div style="color: red;">{{ $errors->first('date_entry') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Initial Weight</label>
                            <input type="number" class="form-control" name="initial_weight" placeholder="Enter Initial Weight" value="{{ old('initial_weight') }}">
                            <div style="color: red;">{{ $errors->first('initial_weight') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Current Weight</label>
                            <input type="number" class="form-control" name="current_weight" placeholder="Enter Current Weight" value="{{ old('current_weight') }}">
                            <div style="color: red;">{{ $errors->first('current_weight') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                          <label>Status <span style="color: red">*</span> </label>
                          <select name="status" id="" class="form-control" required>
                            <option value="">Select Status</option> 
                            <option {{ (old('status') == 'Breeder') ? 'selected' : '' }} value="Breeder">Breeder</option> 
                            <option {{ (old('status') == 'Grower') ? 'selected' : '' }} value="Grower">Grower</option> 
                            <option {{ (old('status') == 'Fattener') ? 'selected' : '' }} value="Fattener">Fattener</option> 
                          </select>
                          <div style="color: red;">{{ $errors->first('status') }}</div>
                        </div>

                        {{-- <div class="form-group col-md-4">
                            <label>Picture </label>
                            <input type="file" class="form-control" name="picture" >
                            <div style="color: red;">{{ $errors->first('picture') }}</div>
                        </div> --}}

                        <div class="form-group col-md-12">
                            <label>Remarks <span style="color: red"></span> </label>
                            <textarea class="form-control" name="remarks" rows="3" placeholder="Add details of activity">{{ old('remarks') }}</textarea>
                            <div style="color: red;">{{ $errors->first('remarks') }}</div>
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