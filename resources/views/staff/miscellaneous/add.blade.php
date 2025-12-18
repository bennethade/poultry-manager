@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Miscellaneous Record</h1>
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
              <form method="POST" action="{{ route('staff.miscellaneous.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Title<span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="title" required placeholder="Eg: 20 crates of eggs, 10 broilers" value="{{ old('title') }}">
                            <div style="color: red;">{{ $errors->first('title') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Category <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="category" required placeholder="Enter category here" value="{{ old('category') }}">
                            <div style="color: red;">{{ $errors->first('category') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Value <span style="color: red"></span> </label> 
                            <input type="text" class="form-control" name="value" placeholder="Eg: 2500 or 3 Bags" value="{{ old('value') }}">
                            <div style="color: red;">{{ $errors->first('value') }}</div>
                        </div>

                        
                        <div class="form-group col-md-4">
                            <label>Date <span style="color: red"></span> </label>
                            <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                            <div style="color: red;">{{ $errors->first('date') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Picture </label>
                            <input type="file" class="form-control" name="picture" >
                            <div style="color: red;">{{ $errors->first('picture') }}</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Description<span style="color: red"></span> </label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Add details of sale made">{{ old('description') }}</textarea>
                            <div style="color: red;">{{ $errors->first('description') }}</div>
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