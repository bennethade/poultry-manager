@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Feed Formulation</h1>
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
              <form method="POST" action="{{ route('feed_formulation.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Formulation Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="formulation_date" required value="{{ old('formulation_date') }}">
                            <div style="color: red;">{{ $errors->first('formulation_date') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Feed Stage</label>
                            <input type="text" class="form-control" name="feed_stage" placeholder="Eg: Starter, Grower, etc." value="{{ old('feed_stage') }}">
                            <div style="color: red;">{{ $errors->first('feed_stage') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Quantity (KG)</label>
                            <input type="number" class="form-control" name="quantity" placeholder="Eg: 20" value="{{ old('quantity') }}">
                            <div style="color: red;">{{ $errors->first('quantity') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Total Output (KG)</label>
                            <input type="number" class="form-control" name="total_output" placeholder="Eg: 30" value="{{ old('total_output') }}">
                            <div style="color: red;">{{ $errors->first('total_output') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Cost</label>
                            <input type="number" class="form-control" name="cost" placeholder="2000" value="{{ old('cost') }}">
                            <div style="color: red;">{{ $errors->first('cost') }}</div>
                        </div>


                        <div class="form-group col-md-9">
                            <label>Ingredients Used</label>
                            <input type="text" class="form-control" name="ingredients_used" placeholder="Eg: Corn, wheat...," value="{{ old('ingredients_used') }}">
                            <div style="color: red;">{{ $errors->first('ingredients_used') }}</div>
                        </div>

                        
                        <div class="form-group col-md-12">
                            <label>Remark <span style="color: red"></span> </label>
                            <textarea class="form-control" name="remarks" rows="3" placeholder="Add any extra remarks">{{ old('remarks') }}</textarea>
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