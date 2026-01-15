<div class="row">
    <div class="form-group col-md-6">
        <label>Care Type<span style="color: red">*</span> </label>
        <input type="text" class="form-control" name="care_type" required placeholder="Eg: Feeding, Watering, ..." value="{{ old('care_type') }}">
        <div style="color: red;">{{ $errors->first('care_type') }}</div>
    </div>

    <div class="form-group col-md-6">
        <label>Quantity</label>
        <input type="text" class="form-control" name="quantity" placeholder="Quantity of activity" value="{{ old('quantity') }}">
        <div style="color: red;">{{ $errors->first('quantity') }}</div>
    </div>

    <div class="form-group col-md-4">
        <label>House or Unit</label>
        <input type="text" class="form-control" name="house_or_unit" placeholder="Detail of the location" value="{{ old('house_or_unit') }}">
        <div style="color: red;">{{ $errors->first('house_or_unit') }}</div>
    </div>

    <div class="form-group col-md-4">
        <label>Date <span style="color: red">*</span> </label>
        <input type="date" class="form-control" name="date" required value="{{ old('date') }}">
        <div style="color: red;">{{ $errors->first('date') }}</div>
    </div>

    <div class="form-group col-md-4">
        <label>Picture </label>
        <input type="file" class="form-control" name="picture" >
        <div style="color: red;">{{ $errors->first('picture') }}</div>
    </div>

    <div class="form-group col-md-12">
        <label>Activity Detail <span style="color: red">*</span> </label>
        <textarea class="form-control" name="notes" rows="3" placeholder="Add details of activity" required>{{ old('notes') }}</textarea>
        <div style="color: red;">{{ $errors->first('notes') }}</div>
    </div>
    
    
</div>