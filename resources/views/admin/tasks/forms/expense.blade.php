
        <div class="row">
            <div class="form-group col-md-8">
                <label>Category<span style="color: red">*</span> </label>
                <input type="text" class="form-control" name="category" required placeholder="Eg: Feed, Utilities, Medicine, Fuel, etc." value="{{ old('category') }}">
                <div style="color: red;">{{ $errors->first('category') }}</div>
            </div>

            <div class="form-group col-md-4">
                <label>Amount <span style="color: red">*</span> </label>
                <input type="number" class="form-control" name="amount" required placeholder="Eg: 500" value="{{ old('amount') }}">
                <div style="color: red;">{{ $errors->first('amount') }}</div>
            </div>

            <div class="form-group col-md-4">
                <label>Payment Method</label>
                <input type="text" class="form-control" name="payment_method" placeholder="Cash, Transfer, etc." value="{{ old('payment_method') }}">
                <div style="color: red;">{{ $errors->first('payment_method') }}</div>
            </div>

            <div class="form-group col-md-4">
                <label>Expense Date <span style="color: red">*</span> </label>
                <input type="date" class="form-control" name="date" required value="{{ old('date') }}">
                <div style="color: red;">{{ $errors->first('date') }}</div>
            </div>

            <div class="form-group col-md-4">
                <label>Picture </label>
                <input type="file" class="form-control" name="picture" >
                <div style="color: red;">{{ $errors->first('picture') }}</div>
            </div>

            <div class="form-group col-md-6">
                <label>Description <span style="color: red">*</span> </label>
                <textarea class="form-control" name="description" rows="3" placeholder="Add details of expense made" required>{{ old('description') }}</textarea>
                <div style="color: red;">{{ $errors->first('description') }}</div>
            </div>

            <div class="form-group col-md-6">
                <label>Purpose <span style="color: red"></span> </label>
                <textarea class="form-control" name="purpose" rows="3" placeholder="Add details of expense made">{{ old('purpose') }}</textarea>
                <div style="color: red;">{{ $errors->first('purpose') }}</div>
            </div>
               
        </div>

   