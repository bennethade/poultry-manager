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
        <form action="{{ route('heating.more_record.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">

                @include('_message')
                
                <div id="breedFormBody" style="">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Date</label>
                            <input class="form-control" type="date" name="date" value="{{ old('date', $getRecord->date) }}">
                        </div>
                        
                        <div class="form-group col-md-8">
                            <label>Observation</label>
                            <textarea class="form-control" rows="1" name="observation" placeholder="Today's observations">{{ old('observation', $getRecord->observation) }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control" rows="2" name="remarks" placeholder="More details here">{{ old('remarks', $getRecord->remarks) }}</textarea>
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

