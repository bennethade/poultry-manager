@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>Edit Record</h5>
        </div>
        <div class="col-sm-6" style="text-align: right;">

        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('farm_inventory.more_record.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">

                @include('_message')
                
                <div id="breedFormBody" style="">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Date</label>
                            <input class="form-control" type="date" name="date" value="{{ old('date', $getRecord->date) }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Quantity Used</label>
                            <input class="form-control" type="text" name="quantity_used" placeholder="Today's usage" value="{{ old('quantity_used', $getRecord->quantity_used) }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Quantity Remaining</label>
                            <input class="form-control" type="text" name="quantity_remaining" placeholder="Total remaining" value="{{ old('quantity_remaining', $getRecord->quantity_remaining) }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Current State</label>
                            <input class="form-control" type="text" name="current_state" placeholder="State of item" value="{{ old('current_state', $getRecord->current_state) }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Remarks</label>
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

