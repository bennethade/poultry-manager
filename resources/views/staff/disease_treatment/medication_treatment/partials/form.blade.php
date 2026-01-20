<div class="row">
   
   
   <div class="col-md-4 mb-3">
      <label class="fw-bold">Select Pigs</label>
      <select
         name="pig_ids[]"
         id="pigSelect"
         class="form-control"
         multiple
         required
      >
         {{-- Select All --}}
         <option value="__all__">Select All</option>

         @foreach($pigs as $pig)
               <option
                  value="{{ $pig->id }}"
                  @if(isset($selectedPigIds) && in_array($pig->id, $selectedPigIds)) selected @endif
               >
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
   <div class="col-md-3 mb-3">
      <label>Dosage</label>
      <input type="text" name="dosage" class="form-control"
         value="{{ $record->dosage ?? '' }}" required>
   </div>
   <div class="col-md-3 mb-3">
      <label>Duration</label>
      <input type="text" name="duration" class="form-control"
         value="{{ $record->duration ?? '' }}" required>
   </div>

   <div class="col-md-3 mb-3">
      <label>Next Due Date</label>
      <input type="date" name="next_due_date" class="form-control"
         value="{{ $record->next_due_date ?? '' }}">
   </div>

   <div class="col-md-3 mb-3">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {

    const SELECT_ALL_VALUE = '__all__';

    $('#pigSelect').select2({
        placeholder: 'Select pigs',
        closeOnSelect: false,
        width: '100%',
        templateResult: formatOption,
        templateSelection: formatSelection
    });

    function formatOption(option) {
        if (!option.id) return option.text;

        return $(`
            <span>
                <input type="checkbox" style="margin-right:6px;" />
                ${option.text}
            </span>
        `);
    }

    function formatSelection(option) {
        return option.text;
    }

    // Select All logic
    $('#pigSelect').on('select2:select', function (e) {
        if (e.params.data.id === SELECT_ALL_VALUE) {
            let allValues = [];

            $('#pigSelect option').each(function () {
                if (this.value !== SELECT_ALL_VALUE) {
                    allValues.push(this.value);
                }
            });

            $('#pigSelect').val(allValues).trigger('change');
        }
    });

    $('#pigSelect').on('select2:unselect', function (e) {
        if (e.params.data.id === SELECT_ALL_VALUE) {
            $('#pigSelect').val(null).trigger('change');
        }
    });

});
</script>
@endsection

