@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Animal</h1>
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
              <form method="POST" action="{{ route('staff.animal_identification.update', $getRecord->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">

                      <div class="form-group col-md-3">
                            <label>Source <span style="color: red">*</span> </label>
                            <select name="source" id="" class="form-control" required>
                                <option value="">Select Source</option> 
                                <option {{ (old('source', $getRecord->source) == 'Born') ? 'selected' : '' }} value="Born">Born</option> 
                                <option {{ (old('source', $getRecord->source) == 'Purchased') ? 'selected' : '' }} value="Purchased">Purchased</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('source') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Date of Birth<span style="color: red"></span> </label>
                            <input type="date" class="form-control" name="dob" value="{{ old('dob', $getRecord->dob) }}">
                            <div style="color: red;">{{ $errors->first('dob') }}</div>
                        </div>

                        
                        <div class="form-group col-md-3">
                          <label>Sex <span style="color: red">*</span> </label>
                          <select name="sex" id="" class="form-control" required>
                            <option value="">--Select Sex--</option> 
                            <option {{ (old('sex', $getRecord->sex) == 'Male') ? 'selected' : '' }} value="Male">Boar</option> 
                            <option {{ (old('sex', $getRecord->sex) == 'Female') ? 'selected' : '' }} value="Female">Sow</option> 
                          </select>
                          <div style="color: red;">{{ $errors->first('sex') }}</div>
                        </div>
                        
                        <div class="form-group col-md-3">
                          <label>Stage <span style="color: red"></span> </label>
                          <select name="stage" id="" class="form-control">
                            <option value="">--Select stage--</option> 
                            <option {{ (old('stage', $getRecord->stage) == 'Adult') ? 'selected' : '' }} value="Adult">Adult</option> 
                            <option {{ (old('stage', $getRecord->stage) == 'Boar Piglet') ? 'selected' : '' }} value="Boar Piglet">Boar Piglet</option> 
                            <option {{ (old('stage', $getRecord->stage) == 'Gilt Piglet') ? 'selected' : '' }} value="Gilt Piglet">Gilt Piglet</option> 
                          </select>
                          <div style="color: red;">{{ $errors->first('stage') }}</div>
                        </div>
                        
                        
                        <div class="form-group col-md-3">
                            <label>Entry Date<span style="color: red"></span> </label>
                            <input type="date" class="form-control" name="date_entry" value="{{ old('date_entry', $getRecord->date_entry) }}">
                            <div style="color: red;">{{ $errors->first('date_entry') }}</div>
                        </div>

                        <div class="form-group col-md-5">
                          <label>Breed</label>
                            <input type="text" class="form-control" name="breed" placeholder="Eg: TN-TEMPO" value="{{ old('breed', $getRecord->breed) }}">
                            <div style="color: red;">{{ $errors->first('breed') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                          <label>Initial Weight</label>
                            <input type="number" class="form-control" name="initial_weight" placeholder="Enter Initial Weight" value="{{ old('initial_weight', $getRecord->initial_weight) }}">
                            <div style="color: red;">{{ $errors->first('initial_weight') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Current Weight</label>
                            <input type="number" class="form-control" name="current_weight" placeholder="Enter Current Weight" value="{{ old('current_weight', $getRecord->current_weight) }}">
                            <div style="color: red;">{{ $errors->first('current_weight') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                          <label>Production Stage <span style="color: red">*</span> </label>
                          <select name="production_stage" id="" class="form-control" required>
                            <option value="">--Select Production Stage--</option> 
                            <option {{ (old('production_stage', $getRecord->production_stage) == 'Breeder') ? 'selected' : '' }} value="Breeder">Breeder</option> 
                            <option {{ (old('production_stage', $getRecord->production_stage) == 'Farrowing') ? 'selected' : '' }} value="Farrowing">Farrowing</option> 
                            <option {{ (old('production_stage', $getRecord->production_stage) == 'Fattener') ? 'selected' : '' }} value="Fattener">Fattener</option> 
                            <option {{ (old('production_stage', $getRecord->production_stage) == 'Gestation') ? 'selected' : '' }} value="Gestation">Gestation</option> 
                            <option {{ (old('production_stage', $getRecord->production_stage) == 'Gilt') ? 'selected' : '' }} value="Gilt">Gilt</option> 
                            <option {{ (old('production_stage', $getRecord->production_stage) == 'Grower') ? 'selected' : '' }} value="Grower">Grower</option> 
                            <option {{ (old('production_stage', $getRecord->production_stage) == 'Lactating') ? 'selected' : '' }} value="Lactating">Lactating</option> 
                          </select>
                          <div style="color: red;">{{ $errors->first('production_stage') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                          <label>Status <span style="color: red">*</span> </label>
                          <select name="status" id="" class="form-control" required>
                            <option {{ (old('status', $getRecord->status) == '1') ? 'selected' : '' }} value="1">Active</option> 
                            <option {{ (old('status', $getRecord->status) == '0') ? 'selected' : '' }} value="0">Inactive</option> 
                          </select>
                          <div style="color: red;">{{ $errors->first('status') }}</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Remarks <span style="color: red"></span> </label>
                            <textarea class="form-control" name="remarks" rows="3" placeholder="Any additional info">{{ old('remarks', $getRecord->remarks) }}</textarea>
                            <div style="color: red;">{{ $errors->first('remarks') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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