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
        <form action="{{ route('breeding_record.more_record.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">

                @include('_message')
                
                <div id="breedFormBody" style="">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" required value="{{ old('date', $getRecord->date) }}">
                        </div>

                        <div class="col-md-4">
                            <label>Number Alive</label>
                            <input type="number" class="form-control" name="number_alive" placeholder="Number alive" value="{{ old('number_alive', $getRecord->number_alive) }}">
                        </div>

                        <div class="col-md-4">
                            <label>Still Birth</label>
                            <input type="number" class="form-control" name="still_birth" placeholder="Still birth" value="{{ old('still_birth', $getRecord->still_birth) }}">
                        </div>

                        <div class="col-md-6 mt-2">
                            <label>More Detail</label>
                            <textarea class="form-control" name="more_detail" rows="2" placeholder="Breeding explanation">{{ old('more_detail', $getRecord->more_detail) }}</textarea>
                        </div>
                        
                        <div class="col-md-6 mt-2">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks" rows="2" placeholder="Any additional notes">{{ old('remarks', $getRecord->remarks) }}</textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <button class="btn btn-primary">Update Record</button>
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

