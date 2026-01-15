@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Stock Record</h1>
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
              <form method="POST" action="{{ route('staff.feed_stock.update', $getRecord->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Received Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="received_date" required value="{{ old('received_date', $getRecord->received_date) }}">
                            <div style="color: red;">{{ $errors->first('received_date') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Feed Material</label>
                            <input type="text" class="form-control" name="feed_material" placeholder="Feed Material" value="{{ old('feed_material', $getRecord->feed_material) }}">
                            <div style="color: red;">{{ $errors->first('feed_material') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Feed Type</label>
                            <input type="text" class="form-control" name="feed_type" placeholder="Feed Type" value="{{ old('feed_type', $getRecord->feed_type) }}">
                            <div style="color: red;">{{ $errors->first('feed_type') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Quantity Received (KG)</label>
                            <input type="number" class="form-control" name="quantity_received" placeholder="eg 50" value="{{ old('quantity_received', $getRecord->quantity_received) }}">
                            <div style="color: red;">{{ $errors->first('quantity_received') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Remaining Stock (KG)</label>
                            <input type="number" class="form-control" name="remaining_stock" placeholder="eg 20" value="{{ old('remaining_stock', $getRecord->remaining_stock) }}">
                            <div style="color: red;">{{ $errors->first('remaining_stock') }}</div>
                        </div>


                        <div class="form-group col-md-4">
                            <label>Supplier</label>
                            <input type="text" class="form-control" name="supplier" placeholder="Sam Larry" value="{{ old('supplier', $getRecord->supplier) }}">
                            <div style="color: red;">{{ $errors->first('supplier') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Cost</label>
                            <input type="number" class="form-control" name="cost" placeholder="2000" value="{{ old('cost', $getRecord->cost) }}">
                            <div style="color: red;">{{ $errors->first('cost') }}</div>
                        </div>
                        

                        <div class="form-group col-md-4">
                            <label>Picture </label>
                            <input type="file" class="form-control" name="picture" >
                            <div style="color: red;">{{ $errors->first('picture') }}</div>
                        </div>

                        <div class="form-group col-md-2">
                            @if (!empty($getRecord->picture))
                                <a href="{{ asset('upload/feed_stock/' . $getRecord->picture) }}" target="_blank">
                                    <img 
                                        src="{{ asset('upload/feed_stock/' . $getRecord->picture) }}" 
                                        alt="Picture" 
                                        style="width: 80px; height: auto; object-fit: cover; border-radius: 10px;"
                                    >
                                </a>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <label>Note <span style="color: red"></span> </label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Add any extra notes">{{ old('notes', $getRecord->notes) }}</textarea>
                            <div style="color: red;">{{ $errors->first('notes') }}</div>
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