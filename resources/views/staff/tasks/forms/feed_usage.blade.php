<div class="row col-md-12">                      

    <div class="form-group col-md-4">
        <label>Feeding Date <span style="color: red">*</span></label>
        <input class="form-control" type="date" name="feeding_date" required>
    </div>

    <div class="form-group col-md-6">
        <label>Feed Type</label>
        <input class="form-control" type="text" name="feed_type" placeholder="Enter type here">
    </div>

    <div class="form-group col-md-2">
        <label>Quantity Fed (KG)</label>
        <input class="form-control" type="number" name="quantity_fed" placeholder="Eg: 30">
    </div>

    <div class="form-group col-md-4">
        <label>Time Of Day <span style="color: red">*</span></label>
        <select class="form-control" name="time_of_day" required>
            <option value="">Select</option>
            <option value="Morning">Morning</option>
            <option value="Afternoon">Afternoon</option>
            <option value="Evening">Evening</option>
        </select>
    </div>

    <div class="form-group col-md-8">
        <label>Remarks</label>
        <textarea class="form-control" rows="1" name="remarks" placeholder="Additional note"></textarea>
    </div>
</div>