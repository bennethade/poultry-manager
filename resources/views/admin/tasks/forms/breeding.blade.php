

    <div class="row">

        <div class="form-group col-md-4">
            <label>Sow</label>
            <select name="sow_id" id="" class="form-control">
                <option value="">Choose Sow ID</option>
                @foreach($sows as $sow)
                    <option value="{{ $sow->tag_id }}" data-id="{{ $sow->id }}">{{ $sow->tag_id }}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group col-md-4">
            <label>Boar</label>
            <select name="boar_id" id="" class="form-control">
                <option value="">Choose Boar ID</option>
                @foreach($boars as $boar)
                    <option value="{{ $boar->tag_id }}" data-id="{{ $boar->id }}">{{ $boar->tag_id }}</option>
                @endforeach
            </select>
        </div>

        
        <div class="form-group col-md-4">
            <label>Breeding Type</label>
            <select class="form-control" name="type">
                <option value="Natural">Natural</option>
                <option value="Artificial Insemination">Artificial Insemination</option>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label>Expected Farrowing Date</label>
            <input class="form-control" type="date" name="expected_farrow_date">
        </div>

        <div class="form-group col-md-3">
            <label>Actual Farrowing Date</label>
            <input class="form-control" type="date" name="actual_farrow_date">
        </div>

        <div class="form-group col-md-3">
            <label>No. Born Alive</label>
            <input class="form-control" type="number" name="number_of_born_alive">
        </div>

        <div class="form-group col-md-3">
            <label>No. of Stillborn</label>
            <input class="form-control" type="number" name="number_of_stillborn">
        </div>

        <div class="form-group col-md-12">
            <label>Remarks</label>
            <textarea class="form-control" rows="1" name="remarks"></textarea>
        </div>
        
    </div>
