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
        <form action="{{ route('medication_treatment.more_record.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">

                @include('_message')
                
                <div id="breedFormBody">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Date</label>
                            <input class="form-control" type="date" name="date" value="{{ old('date', $getRecord->date) }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Drug Info</label>
                            <input class="form-control" type="text" name="drug_info" placeholder="Drug detail" value="{{ old('drug_info', $getRecord->drug_info) }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Dosage</label>
                            <input class="form-control" type="text" name="dosage" placeholder="Drug Dosage" value="{{ old('dosage', $getRecord->dosage) }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Initial Remark</label>
                            <textarea class="form-control" rows="2" name="initial_remark"  placeholder="Initial remark">{{ old('initial_remark', $getRecord->initial_remark) }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Current Remark</label>
                            <textarea class="form-control" rows="2" name="current_remark"  placeholder="Current Remark">{{ old('current_remark', $getRecord->current_remark) }}</textarea>
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

