@extends('layouts.app')
@section('content')
{{-- 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
--}}
<div class="content-wrapper">
   <section class="content-header">
      <h1>Add Vaccine Schedule</h1>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card shadow-sm">
            <div class="card-body">
               <form method="POST" action="{{ route('vaccine_schedule.update', $record->id) }}">
                  @csrf
                  <div class="row">
                     <div class="col-md-4 mb-3">
                        <label>Pig ID</label>
                        <select name="pig_id" id="pigSelect" class="form-control" required>
                            @foreach($pigs as $pig)
                                <option value="{{ $pig->id }}" {{ $record->pig_id == $pig->id ? 'selected' : '' }}>
                                    {{ old('tag_id', $pig->tag_id) }}
                                </option>
                            @endforeach
                        </select>
                     </div>

                     <div class="col-md-4 mb-3">
                        <label>Vaccine Name</label>
                        <input type="text" name="vaccine_name" value="{{ old('vaccine_name', $record->vaccine_name) }}" placeholder="Name of vaccine" class="form-control" required>
                     </div>

                     <div class="col-md-4 mb-3">
                        <label>Age Given</label>
                        <input type="text" name="age_given" value="{{ old('age_given', $record->age_given) }}" class="form-control" placeholder="Age of animal" required>
                     </div>

                  </div>


                  <div class="row">
                     <div class="col-md-4 mb-3">
                        <label>Administered By</label>
                        <input type="text" name="administered_by" value="{{ old('administered_by', $record->administered_by) }}" placeholder="Vet Name" class="form-control" required>
                     </div>

                     <div class="col-md-4 mb-3">
                        <label>Date Given</label>
                        <input type="date" name="date_given" value="{{ old('date_given', $record->date_given) }}" class="form-control" required>
                     </div>
                     
                     <div class="col-md-4 mb-3">
                        <label>Next Due Date</label>
                        <input type="date" name="next_due_date" value="{{ old('next_due_date', $record->next_due_date) }}" class="form-control">
                     </div>
                  </div>

                  <div class="mb-3">
                     <label>Remark</label>
                     <textarea name="remarks" rows="2" placeholder="Any additional note" class="form-control" required>{{ old('remarks', $record->remarks) }}</textarea>
                  </div>

                  <div class="text-end">
                     <button class="btn btn-success">
                     <i class="fas fa-save"></i> Update
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   $(document).ready(function () {
       $('#pigSelect').select2({
           placeholder: 'Search here...',
           allowClear: true,
           width: '100%'
       });
   });
</script>
@endsection