<div class="row">
    <div class="col-md-4 mb-3">
    <label>Pig ID</label>
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
    <label>Vaccine Name</label>
    <input type="text" name="vaccine_name" placeholder="Name of vaccine" class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
    <label>Age Given</label>
    <input type="text" name="age_given" class="form-control" placeholder="Age of animal" required>
    </div>



    <div class="col-md-4 mb-3">
    <label>Administered By</label>
    <input type="text" name="administered_by" placeholder="Vet Name" class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
    <label>Date Given</label>
    <input type="date" name="date_given" class="form-control" required>
    </div>
    
    <div class="col-md-4 mb-3">
    <label>Next Due Date</label>
    <input type="date" name="next_due_date" class="form-control" required>
    </div>

    <div class="col-md-12 mb-3">
        <label>Remark</label>
        <textarea name="remarks" rows="2" placeholder="Any additional note" class="form-control" required></textarea>
    </div>
</div>
