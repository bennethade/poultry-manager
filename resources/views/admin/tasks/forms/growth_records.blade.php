<div class="row col-md-12">

    <div class="col-md-3">
        <label for="">Pig ID</label>
        <select name="pig_id" id="" class="form-control">
            <option value="">Choose Pig ID</option>
            @foreach($pigs as $pig)
                <option value="{{ $pig->tag_id }}" data-id="{{ $pig->id }}">{{ $pig->tag_id }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label>Measurement Date</label>
        <input type="date" class="form-control" name="measurement_date">
    </div>

    <div class="col-md-2">
        <label>Age (Days)</label>
        <input type="number" class="form-control" name="age_in_days" placeholder="Number of days">
    </div>

    <div class="col-md-2">
        <label>Age (Weeks)</label>
        <input type="number" class="form-control" name="age_in_weeks" placeholder="Number of weeks">
    </div>

    <div class="col-md-2">
        <label>Weight (kg)</label>
        <input type="number" step="0.1" class="form-control" name="weight">
    </div>

    <div class="col-md-4 mt-3 mb-3">
        <label>Feed Type</label>
        <input type="text" class="form-control" name="feed_type">
    </div>

    <div class="col-md-8 mt-3 mb-3">
        <label>Remarks</label>
        <textarea class="form-control" name="remarks" rows="1"></textarea>
    </div>

</div>