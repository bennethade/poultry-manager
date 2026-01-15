<div class="row col-md-12">
    <div class="form-group col-md-6">
        <label>Received Date <span style="color: red">*</span> </label>
        <input type="date" class="form-control" name="received_date" required value="{{ old('received_date') }}">
        <div style="color: red;">{{ $errors->first('received_date') }}</div>
    </div>

    <div class="form-group col-md-6">
        <label>Feed Type</label>
        <input type="text" class="form-control" name="feed_type" placeholder="Feed Type" value="{{ old('feed_type') }}">
        <div style="color: red;">{{ $errors->first('feed_type') }}</div>
    </div>


    <div class="form-group col-md-4">
        <label>Quantity Received (KG)</label>
        <input type="number" class="form-control" name="quantity_received" placeholder="eg 50" value="{{ old('quantity_received') }}">
        <div style="color: red;">{{ $errors->first('quantity_received') }}</div>
    </div>

    <div class="form-group col-md-4">
        <label>Remaining Stcok (KG)</label>
        <input type="number" class="form-control" name="remaining_stock" placeholder="eg 20" value="{{ old('remaining_stock') }}">
        <div style="color: red;">{{ $errors->first('remaining_stock') }}</div>
    </div>


    <div class="form-group col-md-4">
        <label>Supplier</label>
        <input type="text" class="form-control" name="supplier" placeholder="Sam Larry" value="{{ old('supplier') }}">
        <div style="color: red;">{{ $errors->first('supplier') }}</div>
    </div>


    <div class="form-group col-md-6">
        <label>Cost</label>
        <input type="number" class="form-control" name="cost" placeholder="2000" value="{{ old('cost') }}">
        <div style="color: red;">{{ $errors->first('cost') }}</div>
    </div>
    

    <div class="form-group col-md-6">
        <label>Picture </label>
        <input type="file" class="form-control" name="picture" >
        <div style="color: red;">{{ $errors->first('picture') }}</div>
    </div>

    <div class="form-group col-md-12">
        <label>Note <span style="color: red"></span> </label>
        <textarea class="form-control" name="notes" rows="3" placeholder="Add any extra notes">{{ old('notes') }}</textarea>
        <div style="color: red;">{{ $errors->first('notes') }}</div>
    </div>
    
    
</div>