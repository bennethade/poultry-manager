@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Feed Usage Record</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <form action="{{ route('staff.daily_feed_usage.update', $getRecord->id) }}" method="POST" class="breeding-form">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Feeding Date</label>
                        <input class="form-control" type="date" name="feeding_date" required value="{{ old('feeding_date', $getRecord->feeding_date) }}">
                    </div>

                    <div class="form-group col-md-5">
                        <label>Feed Type</label>
                        <input class="form-control" type="text" name="feed_type" placeholder="Enter type here" value="{{ old('feed_type', $getRecord->feed_type) }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Quantity Fed (KG)</label>
                        <input class="form-control" type="number" name="quantity_fed" placeholder="Eg: 30" value="{{ old('quantity_fed', $getRecord->quantity_fed) }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Time Of Day</label>
                        <select class="form-control" name="time_of_day" required>
                            <option value="">Select</option>
                            <option {{ old('time_of_day', $getRecord->time_of_day == 'Morning' ? 'selected' : '') }} value="Morning">Morning</option>
                            <option {{ old('time_of_day', $getRecord->time_of_day == 'Afternoon' ? 'selected' : '') }} value="Afternoon">Afternoon</option>
                            <option {{ old('time_of_day', $getRecord->time_of_day == 'Evening' ? 'selected' : '') }} value="Evening">Evening</option>
                        </select>
                    </div>

                    <div class="form-group col-md-8">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="1" name="remarks" placeholder="Additional note">{{ old('remarks', $getRecord->remarks) }}</textarea>
                    </div>

                    <div class="form-group col-md-4" style="margin-top: 10px;">
                        <label></label>
                        <button class="form-control btn-primary" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </div>

        </form>
        
      </div>    

    </div>
  </section>




</div>




@endsection