<div class="row">
   <div class="col-md-4 mb-3">
      <label>Pig</label>
      {{-- <select name="pig_id" class="form-control" required>
        @foreach($pigs as $pig)
            <option value="{{ $pig->id }}" @if(isset($record) && $record->pig_id == $pig->id) selected @endif>
                {{ $pig->tag_id }}
            </option>
        @endforeach
      </select> --}}

      <select name="pig_id" id="pigSelect" class="form-control" required>
         <option value="">Select Pig</option>
         @foreach($pigs as $pig)
         <option value="{{ $pig->id }}"  @if(isset($record) && $record->pig_id == $pig->id) selected @endif>
            {{ $pig->tag_id }}
         </option>
         @endforeach
      </select>

      
   </div>
   <div class="col-md-4 mb-3">
      <label>Date</label>
      <input type="date" name="date" class="form-control"
         value="{{ $record->date ?? '' }}" required>
   </div>
   <div class="col-md-4 mb-3">
      <label>Drug Name</label>
      <input type="text" name="drug_name" class="form-control"
         value="{{ $record->drug_name ?? '' }}" required>
   </div>
</div>
<div class="row">
   <div class="col-md-4 mb-3">
      <label>Dosage</label>
      <input type="text" name="dosage" class="form-control"
         value="{{ $record->dosage ?? '' }}" required>
   </div>
   <div class="col-md-4 mb-3">
      <label>Duration</label>
      <input type="text" name="duration" class="form-control"
         value="{{ $record->duration ?? '' }}" required>
   </div>
   <div class="col-md-4 mb-3">
      <label>Administered By</label>
      <input type="text" name="administered_by" class="form-control"
         value="{{ $record->administered_by ?? '' }}">
   </div>
</div>
<div class="mb-3">
   <label>Remarks</label>
   <textarea name="remarks" class="form-control">{{ $record->remarks ?? '' }}</textarea>
</div>

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