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
              <form method="POST" action="{{ route('farm_inventory.update', $getRecord->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="date" required value="{{ old('date', $getRecord->date) }}">
                            <div style="color: red;">{{ $errors->first('date') }}</div>
                        </div>

                        <div class="form-group col-md-5">
                            <label>Item Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="item_name" placeholder="Item Name" value="{{ old('item_name', $getRecord->item_name) }}">
                            <div style="color: red;">{{ $errors->first('item_name') }}</div>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Category</label>
                            <input type="text" class="form-control" name="category" placeholder="Tool, Chemical..." value="{{ old('category', $getRecord->category) }}">
                            <div style="color: red;">{{ $errors->first('category') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="Item quantity" value="{{ old('quantity', $getRecord->quantity) }}">
                            <div style="color: red;">{{ $errors->first('quantity') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Cost</label>
                            <input type="number" class="form-control" name="cost" placeholder="Eg: 7000" value="{{ old('cost', $getRecord->cost) }}" step="any">
                            <div style="color: red;">{{ $errors->first('cost') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Source </label>
                            <select name="source" id="" class="form-control">
                              <option value="">--Select Source--</option>
                              <option {{ old('Purchased', $getRecord->source == 'Purchased' ? 'selected' : '') }} value="Purchased">Purchased</option>
                              <option {{ old('Home Made', $getRecord->source == 'Home Made' ? 'selected' : '') }} value="Home Made">Home Made</option>
                              <option {{ old('Other', $getRecord->source == 'Other' ? 'selected' : '') }} value="Other">Other</option>
                            </select>
                            <div style="color: red;">{{ $errors->first('source') }}</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Remark <span style="color: red"></span> </label>
                            <textarea class="form-control" name="remarks" rows="3" placeholder="Add any extra notes">{{ old('remarks', $getRecord->remarks) }}</textarea>
                            <div style="color: red;">{{ $errors->first('remarks') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Status <span style="color: red">*</span> </label>
                            <select name="status" id="" class="form-control">
                              <option value="">--Select Status--</option>
                              <option {{ old('Available', $getRecord->status == 'Available' ? 'selected' : '') }} value="Available">Available</option>
                              <option {{ old('Damaged', $getRecord->status == 'Damaged' ? 'selected' : '') }} value="Damaged">Damaged</option>
                              <option {{ old('Sold', $getRecord->status == 'Sold' ? 'selected' : '') }} value="Sold">Sold</option>
                              <option {{ old('Other', $getRecord->status == 'Other' ? 'selected' : '') }} value="Other">Other</option>
                            </select>
                            <div style="color: red;">{{ $errors->first('status') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Picture </label>
                            <input type="file" class="form-control" name="picture" >
                            <div style="color: red;">{{ $errors->first('picture') }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            @if (!empty($getRecord->picture))
                                <a href="{{ asset('upload/farm_inventory/' . $getRecord->picture) }}" target="_blank">
                                    <img 
                                        src="{{ asset('upload/farm_inventory/' . $getRecord->picture) }}" 
                                        alt="Picture" 
                                        style="width: 80px; height: auto; object-fit: cover; border-radius: 10px;"
                                    >
                                </a>
                            @endif
                        </div>
                        
                        <div class="form-group col-md-2" style="margin-top: 30px; text-align:center">
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