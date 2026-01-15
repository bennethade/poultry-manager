@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>Edit Record </h5>
        </div>
        <div class="col-sm-6" style="text-align: right;">
            
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('vaccine_log.more_record.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                
                @include('_message')
                
                
                <div id="breedFormBody">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label>Date <span style="color: red">*</span></label>
                            <input class="form-control" type="date" name="date" value="{{ old('date', $getRecord->date) }}" required>
                        </div>


                        <div class="form-group col-md-8">
                            <label>Quantity Detail</label>
                            <input class="form-control" type="text" name="quantity" placeholder="Quantity" value="{{ old('quantity', $getRecord->quantity) }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Record Details</label>
                            <textarea class="form-control" rows="2" name="remarks"  placeholder="Any additional notes">{{ old('remarks', $getRecord->remarks) }}</textarea>
                        </div>

                        <div class="form-group col-md-12" style="">
                            <button class="form-control btn-primary" type="submit">
                                Update Record
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </form>
        
      </div>    

    </div>
  </section>



</div>



@endsection

