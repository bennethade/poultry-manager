@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Breeding Record</h1>
        </div>
        
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('staff.breeding_record.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Sow</label>
                        <select class="form-control" name="sow_id" required>
                            <option value="">Select Sow</option>
                            @foreach($sows as $sow)
                                <option {{ old('sow_id',$getRecord->sow_id == $sow->id) ? 'selected' : ''  }} value="{{ $sow->id }}">{{ $sow->tag_id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Boar</label>
                        <select class="form-control" name="boar_id" required>
                            <option value="">Select Boar</option>
                            @foreach($boars as $boar)
                                <option {{ old('boar_id',$getRecord->boar_id == $boar->id) ? 'selected' : ''  }} value="{{ $boar->id }}">{{ $boar->tag_id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Breeding Type</label>
                        <select class="form-control" name="type">
                            <option {{ old('type', $getRecord->type == 'Natural') ? 'selected' : '' }} value="Natural">Natural</option>
                            <option {{ old('type', $getRecord->type == 'Artificial Insemination') ? 'selected' : '' }} value="Artificial Insemination">Artificial Insemination</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Expected Farrowing Date</label>
                        <input class="form-control" type="date" name="expected_farrow_date" value="{{ old('expected_farrow_date', $getRecord->expected_farrow_date)}}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Actual Farrowing Date</label>
                        <input class="form-control" type="date" name="actual_farrow_date" value="{{ old('actual_farrow_date', $getRecord->actual_farrow_date)}}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>No. Born Alive</label>
                        <input class="form-control" type="number" name="number_of_born_alive" value="{{ old('number_of_born_alive', $getRecord->number_of_born_alive)}}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>No. of Stillborn</label>
                        <input class="form-control" type="number" name="number_of_stillborn" value="{{ old('number_of_stillborn', $getRecord->number_of_stillborn)}}">
                    </div>

                    <div class="form-group col-md-8">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="1" name="remarks">{{ old('remarks', $getRecord->remarks)}}</textarea>
                    </div>


                    <div class="form-group col-md-4" style="margin-top: 10px;">
                        <label></label>
                        <button class="form-control btn-primary" type="submit">Update Record</button>
                    </div>
                </div>
            </div>

        </form>
        
      </div>    

    </div>
  </section>




</div>




@endsection