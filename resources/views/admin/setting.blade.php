@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Settings</h1>
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

            @include('_message')

            <div class="card card-primary">
              
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">

                  <div class="form-group col-md-4">
                    <label>Fav Icon</label>
                    <input type="file" class="form-control" name="favicon_icon" >
                    @if(!empty($getRecord))
                        <img src="{{ $getRecord->getFavicon() }}" class="" alt="" style="width: 50px">
                    @endif
                  </div>

                  <div class="form-group col-md-4">
                    <label>Business Logo</label>
                    <input type="file" class="form-control" name="logo" >
                    @if(!empty($getRecord))
                        <img src="{{ $getRecord->getLogo() }}" class="" alt="" style="width: 80px; height:auto">
                    @endif
                  </div>


                  <div class="form-group col-md-4">
                    <label>Website QR Code</label>
                    <input type="file" class="form-control" name="qr_code" >
                    @if(!empty($getRecord))
                        <img src="{{ $getRecord->getQrCode() }}" class="" alt="" style="width: 50px">
                    @endif
                  </div>


                  {{-- <div class="form-group col-md-3">
                    <label>Award Seal</label>
                    <input type="file" class="form-control" name="seal" >
                    @if(!empty($getRecord->getSeal()))
                        <img src="{{ $getRecord->getSeal() }}" class="" alt="" style="width: 80px; height:auto">
                    @endif
                  </div> --}}

                  {{-- <div class="form-group col-md-3">
                    <label>Trophy</label>
                    <input type="file" class="form-control" name="trophy" >
                    @if(!empty($getRecord->getTrophy()))
                        <img src="{{ $getRecord->getTrophy() }}" class="" alt="" style="width: 80px; height:auto">
                    @endif
                  </div> --}}


                  <div class="form-group col-md-4">
                    <label>Business Name</label>
                    <input type="text" class="form-control" name="business_name" value="{{ $getRecord->business_name }}" placeholder="Enter Your Business Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Abbreviation</label>
                    <input type="text" class="form-control" name="abbreviation" value="{{ $getRecord->abbreviation }}" placeholder="Enter Abbreviation">
                  </div>

                  {{-- <div class="form-group col-md-3">
                    <label>Shool Motto</label>
                    <input type="text" class="form-control" name="motto" value="{{ $getRecord->motto }}" placeholder="Enter Motto">
                  </div> --}}


                  <div class="form-group col-md-5">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $getRecord->address }}" placeholder="Enter Address">
                  </div>


                  <div class="form-group col-md-6">
                    <label>Email Address 1</label>
                    <input type="email" class="form-control" name="email_1" value="{{ $getRecord->email_1 }}" placeholder="Email Address">
                  </div>


                  <div class="form-group col-md-6">
                    <label>Email Address 2</label>
                    <input type="email" class="form-control" name="email_2" value="{{ $getRecord->email_2 }}" placeholder="Email Address Two">
                  </div>


                  <div class="form-group col-md-4">
                    <label>Phone Number 1</label>
                    <input type="tel" class="form-control" name="phone_1" value="{{ $getRecord->phone_1 }}" placeholder="Phone Number">
                  </div>


                  <div class="form-group col-md-4">
                    <label>Phone Number 2</label>
                    <input type="tel" class="form-control" name="phone_2" value="{{ $getRecord->phone_2 }}" placeholder="Phone Number Two">
                  </div>


                  <div class="form-group col-md-4">
                    <label>Website Address</label>
                    <input type="text" class="form-control" name="website" value="{{ $getRecord->website }}" placeholder="Enter Website Address">
                  </div>

                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>

          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection