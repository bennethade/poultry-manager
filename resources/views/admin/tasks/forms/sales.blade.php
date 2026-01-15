<div class="row">
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

    <div class="form-group col-md-4">
        <label>Reason <span style="color: red">*</span> </label>
        <select name="reason" id="" class="form-control" required>
            <option {{ (old('reason') == 'Sale') ? 'selected' : '' }} value="Sale">Sale</option> 
            <option {{ (old('reason') == 'Cull') ? 'selected' : '' }} value="Cull">Cull</option> 
            <option {{ (old('reason') == 'Death') ? 'selected' : '' }} value="Death">Death</option> 
        </select>
        <div style="color: red;">{{ $errors->first('reason') }}</div>
    </div>

    <div class="form-group col-md-4">
        <label>Quantity <span style="color: red">*</span> </label>
        <input type="text" class="form-control" name="quantity" required placeholder="Enter quantity here" value="{{ old('quantity') }}">
        <div style="color: red;">{{ $errors->first('quantity') }}</div>
    </div>

    <div class="form-group col-md-3">
        <label>Price <span style="color: red"></span> </label> 
        <input type="number" class="form-control" name="price" placeholder="Eg: 2500" value="{{ old('price') }}">
        <div style="color: red;">{{ $errors->first('price') }}</div>
    </div>

    <div class="form-group col-md-3">
        <label>Sold on Discount <span style="color: red">*</span> </label>
        <select name="sold_on_discount" id="" required class="form-control">
            <option {{ (old('sold_on_discount') == '0') ? 'selected' : '' }} value="0">No</option> 
            <option {{ (old('sold_on_discount') == '1') ? 'selected' : '' }} value="1">Yes</option> 
        </select>
        <div style="color: red;">{{ $errors->first('sold_on_discount') }}</div>
    </div>

    <div class="form-group col-md-3">
        <label>Original Price</label>
        <input type="number" class="form-control" name="discounted_price" placeholder="Eg: 2000" value="{{ old('discounted_price') }}">
        <div style="color: red;">{{ $errors->first('discounted_price') }}</div>
    </div>


    <div class="form-group col-md-3">
        <label>Buyer Name</label>
        <input type="text" class="form-control" name="buyer_name" placeholder="Eg: Mr. Daniel David" value="{{ old('buyer_name') }}">
        <div style="color: red;">{{ $errors->first('buyer_name') }}</div>
    </div>

    <div class="form-group col-md-4">
        <label>Buyer Phone</label>
        <input type="text" class="form-control" name="buyer_phone" placeholder="Eg: 08177733366" value="{{ old('buyer_phone') }}">
        <div style="color: red;">{{ $errors->first('buyer_phone') }}</div>
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
        <label>Notes<span style="color: red">*</span> </label>
        <textarea class="form-control" name="notes" rows="3" placeholder="Add details of sale made" required>{{ old('notes') }}</textarea>
        <div style="color: red;">{{ $errors->first('notes') }}</div>
    </div>
    
    
</div>