@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h3> Expense Made: <span style="color: brown">{{ $getRecord->category }}</span></h3>
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
                                <a href="{{ asset('upload/expenses/' . $getRecord->picture) }}" target="_blank">
                                    <img 
                                        src="{{ asset('upload/expenses/' . $getRecord->picture) }}" 
                                        alt="Picture" 
                                        style="width: 100%; height: 400px; object-fit: cover; border-radius: 10px;"
                                    >
                                </a>
                            @endif
                        </div>

                        <hr>
                        <hr>

                        <div class="form-group col-md-5" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                          <label>Amount: </label> <br>
                          {{ $getRecord->amount }}
                        </div>

                        <div class="form-group col-md-5" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                          <label>Payment Method: </label> <br>
                          {{ $getRecord->payment_method }}
                        </div>


                        <div class="form-group col-md-2" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                            <label>Date: </label> <br>
                            {{ date('d-m-Y', strtotime($getRecord->date)) }}
                        </div>

                        

                        <div class="form-group col-md-12" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
                            <label>Description:</label> <br>
                            {{ $getRecord->description }}
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