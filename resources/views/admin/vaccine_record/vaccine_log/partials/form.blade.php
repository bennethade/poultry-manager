<div class="row">
   <div class="col-md-4 mb-3">
      <label>Date</label>
      <input type="date" name="date" class="form-control" value="{{ $record->date ?? '' }}" required>
   </div>
   <div class="col-md-4 mb-3">
      <label>Vaccine Name</label>
      <input type="text" name="vaccine_name" class="form-control" placeholder="Name of vaccine" value="{{ $record->vaccine_name ?? '' }}" required>
   </div>
   <div class="col-md-4 mb-3">
      <label>No. of Pigs Vaccinated</label>
      <input type="number" name="no_of_pigs_vaccinated" placeholder="Total pigs vaccinated" class="form-control" value="{{ $record->no_of_pigs_vaccinated ?? '' }}">
   </div>
</div>

<div class="row">
   <div class="col-md-4 mb-3">
      <label>Batch No.</label>
      <input type="text" name="batch_no" class="form-control" placeholder="Batch No." value="{{ $record->batch_no ?? '' }}">
   </div>

   <div class="col-md-4 mb-3">
      <label>Expiry Date</label>
      <input type="date" name="expiry_date" class="form-control" placeholder="Vaccine Expiry" value="{{ $record->expiry_date ?? '' }}">
   </div>

   <div class="col-md-4 mb-3">
      <label>Vet. Name</label>
      <input type="text" name="vet_name" placeholder="Name of vet doctor" class="form-control" value="{{ $record->vet_name ?? '' }}">
   </div>
</div>
<div class="mb-3">
   <label>Remarks</label>
   <textarea name="remarks" class="form-control" placeholder="Any additional notes">{{ $record->remarks ?? '' }}</textarea>
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