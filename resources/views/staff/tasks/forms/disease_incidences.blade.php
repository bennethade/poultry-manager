<div class="row col-md-12">
    <div class="col-md-4 mb-3">
        <label>Date <span style="color: red">*</span></label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
        <label>Pig ID <span style="color: red">*</span></label>
        <select name="pig_id" id="pigSelect" class="form-control" required>
            <option value="">Select Pig</option>
            @foreach($pigs as $pig)
            <option value="{{ $pig->id }}">
                {{ $pig->tag_id }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 mb-3">
        <label>Suspected Disease <span style="color: red">*</span></label>
        <input type="text" name="suspected_disease" placeholder="Name of disease" class="form-control" required>
    </div>

    <div class="col-md-12 mb-3">
        <label>Symptoms Observed <span style="color: red">*</span></label>
        <textarea name="symptoms_observed" rows="3" placeholder="Describe the symptom observed" class="form-control" required></textarea>
    </div>

    <div class="col-md-4 mb-3">
        <label>Action Taken <span style="color: red">*</span></label>
        <input type="text" name="action_taken" placeholder="What action has been taken" class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
        <label>Vet Name</label>
        <input type="text" name="vet_name" placeholder="Doctor's name" class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label>Outcome</label>
        <input type="text" name="outcome" placeholder="Outcome after action taken" class="form-control">
    </div>
</div>