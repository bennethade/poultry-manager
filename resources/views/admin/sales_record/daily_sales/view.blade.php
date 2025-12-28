@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h3> Sales Made: <span style="color: brown">{{ $getRecord->item_type }}</span></h3>
            </div>

            <div class="col-sm-4">
                <h5> By: <span style="color: blue">{{ $getStaff->last_name }} {{ $getStaff->name }}</span></h5>
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
            <div class="card card-primary">

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            @if (!empty($getRecord->picture))
                                <a href="{{ asset('upload/sales/' . $getRecord->picture) }}" target="_blank">
                                    <img 
                                        src="{{ asset('upload/sales/' . $getRecord->picture) }}" 
                                        alt="Picture" 
                                        style="width: 100%; height: 400px; object-fit: cover; border-radius: 10px;"
                                    >
                                </a>
                            @endif
                        </div>

                        

                        <div class="form-group col-md-3" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                          <label>Quantity: </label> <br>
                          {{ $getRecord->quantity }}
                        </div>

                        <div class="form-group col-md-3" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                          <label>Price: </label> <br>
                          {{ $getRecord->price }}
                        </div>

                        <div class="form-group col-md-3" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                            <label>Sold on Discount: </label> <br>
                            @if ($getRecord->sold_on_discount == 1)
                              Yes
                            @else
                              No
                            @endif
                        </div>

                        <div class="form-group col-md-3" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                          <label>Discount Price: </label> <br>
                          {{ $getRecord->discounted_price }}
                        </div>


                        <div class="form-group col-md-4" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                          <label>Buyer's Name: </label> <br>
                          {{ $getRecord->buyer_name }}
                        </div>

                        <div class="form-group col-md-4" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                          <label>Buyer's Phone: </label> <br>
                          {{ $getRecord->buyer_phone }}
                        </div>


                        <div class="form-group col-md-4" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                            <label>Sales Date: </label> <br>
                            {{ date('d-m-Y', strtotime($getRecord->date)) }}
                        </div>

                        

                        <div class="form-group col-md-12" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                            <label><Datag></Datag>Notes:</label> <br>
                            {{ $getRecord->notes }}
                        </div>
                        
                        
                    </div>

                </div>

                
            </div>

          </div>
         
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

@endsection