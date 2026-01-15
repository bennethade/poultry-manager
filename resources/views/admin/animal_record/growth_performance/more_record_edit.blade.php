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
        <form action="{{ route('growth_performance.more_record.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">

                @include('_message')
                
                <div id="breedFormBody" style="">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Measurement Date</label>
                            <input type="date" class="form-control" name="measurement_date" value="{{ old('measurement_date', $getRecord->measurement_date) }}">
                        </div>

                        <div class="col-md-3">
                            <label>Age (Days)</label>
                            <input type="number" class="form-control" name="age_in_days" placeholder="Age in days" value="{{ old('age_in_days', $getRecord->age_in_days) }}">
                        </div>

                        <div class="col-md-3">
                            <label>Age (Weeks)</label>
                            <input type="number" class="form-control" name="age_in_weeks" placeholder="Age in weeks" value="{{ old('age_in_weeks', $getRecord->age_in_weeks) }}">
                        </div>

                        <div class="col-md-3">
                            <label>Weight (kg)</label>
                            <input type="number" class="form-control" name="weight" step="any" placeholder="Eg: 12.5" value="{{ old('weight', $getRecord->weight) }}">
                        </div>

                        <div class="col-md-4 mt-2">
                            <label>Feed Type</label>
                            <input type="text" class="form-control" name="feed_type" placeholder="Feed type" value="{{ old('feed_type', $getRecord->feed_type) }}">
                        </div>

                        <div class="col-md-8 mt-2">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks" rows="1" placeholder="Any additional notes">{{ old('remarks', $getRecord->remarks) }}</textarea>
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

