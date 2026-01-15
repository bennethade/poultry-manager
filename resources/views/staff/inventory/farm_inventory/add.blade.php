@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Inventory</h1>
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
              <form method="POST" action="{{ route('staff.farm_inventory.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="date" required value="{{ old('date') }}">
                            <div style="color: red;">{{ $errors->first('date') }}</div>
                        </div>

                        <div class="form-group col-md-5">
                            <label>Item Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="item_name" placeholder="Item Name" value="{{ old('item_name') }}">
                            <div style="color: red;">{{ $errors->first('item_name') }}</div>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Category</label>
                            <input type="text" class="form-control" name="category" placeholder="Tool, Chemical..." value="{{ old('category') }}">
                            <div style="color: red;">{{ $errors->first('category') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="Item quantity" value="{{ old('quantity') }}">
                            <div style="color: red;">{{ $errors->first('quantity') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Cost</label>
                            <input type="number" class="form-control" name="cost" placeholder="Eg: 7000" value="{{ old('cost') }}" step="any">
                            <div style="color: red;">{{ $errors->first('cost') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Source </label>
                            <select name="source" id="" class="form-control">
                              <option value="">--Select Source--</option>
                              <option value="Purchased">Purchased</option>
                              <option value="Home Made">Home Made</option>
                              <option value="Other">Other</option>
                            </select>
                            <div style="color: red;">{{ $errors->first('source') }}</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Remark <span style="color: red"></span> </label>
                            <textarea class="form-control" name="remarks" rows="3" placeholder="Add any extra notes">{{ old('remarks') }}</textarea>
                            <div style="color: red;">{{ $errors->first('remarks') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Status <span style="color: red">*</span> </label>
                            <select name="status" id="" class="form-control">
                              <option value="">--Select Status--</option>
                              <option value="Available">Available</option>
                              <option value="Damaged">Damaged</option>
                              <option value="Sold">Sold</option>
                              <option value="Other">Other</option>
                            </select>
                            <div style="color: red;">{{ $errors->first('status') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Picture </label>
                            <input type="file" class="form-control" name="picture" >
                            <div style="color: red;">{{ $errors->first('picture') }}</div>
                        </div>
                        
                        <div class="form-group col-md-4" style="margin-top: 30px; text-align:center">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                    </div>

                </div>

                {{-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> --}}
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