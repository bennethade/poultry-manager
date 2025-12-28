@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Sales</h1>
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
              <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        {{-- <div class="form-group col-md-6">
                            <label>Item<span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="item_type" required placeholder="Item name" value="{{ old('item_type') }}">
                            <div style="color: red;">{{ $errors->first('item_type') }}</div>
                        </div> --}}

                        <div class="col-md-4 mb-3">
                            <label>Pig ID</label>
                            <select name="pig_id" id="pigSelect" class="form-control" required>
                              <option value="">Select Pig</option>
                              @foreach($pigs as $pig)
                              <option value="{{ $pig->id }}">
                                  {{ $pig->tag_id }}
                              </option>
                              @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Reason <span style="color: red"></span> </label>
                            <select name="reason" id="" class="form-control">
                                {{-- <option value="">Choose</option>  --}}
                                <option {{ (old('reason') == 'Sale') ? 'selected' : '' }} value="Sale">Sale</option> 
                                <option {{ (old('reason') == 'Cull') ? 'selected' : '' }} value="Cull">Cull</option> 
                                <option {{ (old('reason') == 'Death') ? 'selected' : '' }} value="Death">Death</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('reason') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Quantity <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="quantity" required placeholder="Enter quantity here" value="{{ old('quantity') }}">
                            <div style="color: red;">{{ $errors->first('quantity') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                          <label>Price <span style="color: red"></span> </label> 
                            <input type="number" class="form-control" name="price" placeholder="Eg: 2500" value="{{ old('price') }}">
                            <div style="color: red;">{{ $errors->first('price') }}</div>
                        </div>

                        {{-- <div class="form-group col-md-4">
                          <label>Sold on Discount</label>
                            <input type="text" class="form-control" name="sold_on_discount" placeholder="Cash, Transfer, etc." value="{{ old('sold_on_discount') }}">
                            <div style="color: red;">{{ $errors->first('sold_on_discount') }}</div>
                        </div> --}}

                        <div class="form-group col-md-3">
                            <label>Sold on Discount <span style="color: red"></span> </label>
                            <select name="sold_on_discount" id="" class="form-control">
                                {{-- <option value="">Choose</option>  --}}
                                <option {{ (old('sold_on_discount') == '0') ? 'selected' : '' }} value="0">No</option> 
                                <option {{ (old('sold_on_discount') == '1') ? 'selected' : '' }} value="1">Yes</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('sold_on_discount') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                          <label>Original Price</label>
                            <input type="number" class="form-control" name="discounted_price" placeholder="Eg: 2000" value="{{ old('discounted_price') }}">
                            <div style="color: red;">{{ $errors->first('discounted_price') }}</div>
                        </div>


                        <div class="form-group col-md-3">
                          <label>Buyer Name</label>
                            <input type="text" class="form-control" name="buyer_name" placeholder="Eg: Mr. Daniel David" value="{{ old('buyer_name') }}">
                            <div style="color: red;">{{ $errors->first('buyer_name') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Buyer Phone</label>
                            <input type="text" class="form-control" name="buyer_phone" placeholder="Eg: 08177733366" value="{{ old('buyer_phone') }}">
                            <div style="color: red;">{{ $errors->first('buyer_phone') }}</div>
                        </div>

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
                            <label>Notes<span style="color: red">*</span> </label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Add details of sale made" required>{{ old('notes') }}</textarea>
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


@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   $(document).ready(function () {
       $('#pigSelect').select2({
           placeholder: 'Search here...',
           allowClear: true,
           width: '100%'
       });
   });
</script>
@endsection