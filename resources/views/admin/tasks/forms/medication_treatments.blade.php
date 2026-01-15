<div class="row col-md-12">
   <div class="col-md-4 mb-3">
      <label>Pig <span style="color: red">*</span></label>
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
      <label>Date <span style="color: red">*</span></label>
      <input type="date" name="date" class="form-control" required>
   </div>

   <div class="col-md-4 mb-3">
      <label>Drug Name <span style="color: red">*</span></label>
      <input type="text" name="drug_name" placeholder="Name of drug" class="form-control" required>
   </div>

   <div class="col-md-4 mb-3">
      <label>Dosage <span style="color: red">*</span></label>
      <input type="text" name="dosage" placeholder="What is the dosage" class="form-control" required>
   </div>

   <div class="col-md-4 mb-3">
      <label>Duration <span style="color: red">*</span></label>
      <input type="text" name="duration" placeholder="For how long" class="form-control" required>
   </div>

   <div class="col-md-4 mb-3">
      <label>Administered By</label>
      <input type="text" name="administered_by" placeholder="Doctor name" class="form-control">
   </div>

    <div class="col-md-12 mb-3">
        <label>Remarks</label>
        <textarea name="remarks" placeholder="Any additional info" class="form-control"></textarea>
    </div>

</div>
