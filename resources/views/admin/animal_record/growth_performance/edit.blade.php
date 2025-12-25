@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>Edit Growth Performance</h1>
        </section>

        <section class="content">
            <div class="container-fluid">

            <!-- 🔍 Pig Selector -->
                <div class="card">
                    <div class="card-body">

                        @include('_message')
                        
                        <label><strong>Select Pig</strong></label>
                        <input type="number" class="form-control" name="{{ $getPig->id }}" list="pigList" placeholder="Search Pig Tag ID" value="{{ $getPig->tag_id }}">
                        {{-- <input type="hidden" name="pig_id" id="pig_id"> --}}

                        <datalist id="pigList">
                            @foreach($pigs as $pig)
                                <option value="{{ $pig->tag_id }}" data-id="{{ $pig->id }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

            <!-- ➕ Add Growth Record -->
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('growth_performance.update', $record->id) }}">
                            @csrf

                            {{-- <input type="hidden" name="pig_id" id="form_pig_id"> --}}
                            <input type="hidden" name="pig_id" id="form_pig_id" value="{{ $getPig->id }}">

                            <div class="row">
                                <div class="col-md-3">
                                    <label>Measurement Date</label>
                                    <input type="date" class="form-control" name="measurement_date" value="{{ $record->measurement_date }}">
                                </div>

                                <div class="col-md-3">
                                    <label>Age (Days)</label>
                                    <input type="number" class="form-control" name="age_in_days" value="{{ $record->age_in_days }}">
                                </div>

                                <div class="col-md-3">
                                    <label>Age (Weeks)</label>
                                    <input type="number" class="form-control" name="age_in_weeks" value="{{ floor($record->age_in_days / 7) }}">
                                </div>

                                <div class="col-md-3">
                                    <label>Weight (kg)</label>
                                    <input type="number" step="0.1" class="form-control" name="weight" value="{{ $record->weight }}">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label>Feed Type</label>
                                    <input type="text" class="form-control" name="feed_type" value="{{ $record->feed_type }}">
                                </div>

                                <div class="col-md-8 mt-2">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="remarks" rows="1">{{ $record->remarks }}</textarea>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                
                </div>

           
            </div>
        </section>
    </div>


@endsection

