@extends('layouts.app')

@section('content')
<div class="content-wrapper">
<section class="content-header">
    <h1>Edit Disease Incidence</h1>
</section>

<section class="content">
<div class="container-fluid">
<div class="card shadow-sm">
<div class="card-body">

<form method="POST" action="{{ route('disease_incidence.update', $record->id) }}">
@csrf

<div class="row">
    <div class="col-md-4 mb-3">
        <label>Date</label>
        <input type="date" name="date" value="{{ old('date', $record->date) }}" class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
        <label>Pig</label>
        <select name="pig_id" id="pigSelect" class="form-control" required>
            @foreach($pigs as $pig)
                <option value="{{ $pig->id }}" {{ $record->pig_id == $pig->id ? 'selected' : '' }}>
                    {{ old('tag_id', $pig->tag_id) }}
                </option>
            @endforeach
        </select>

        {{-- <select name="pig_id" id="pigSelect" class="form-control" required>
            <option value="">Select Pig</option>
            @foreach($pigs as $pig)
                <option value="{{ $pig->id }}">
                    {{ $pig->tag_id }}
                </option>
            @endforeach
        </select> --}}

    </div>

    <div class="col-md-4 mb-3">
        <label>Suspected Disease</label>
        <input type="text" name="suspected_disease" value="{{ old('suspected_disease', $record->suspected_disease) }}" class="form-control" required>
    </div>
</div>

<div class="mb-3">
    <label>Symptoms Observed</label>
    <textarea name="symptoms_observed" rows="4" class="form-control" required>{{ old('symptoms_observed', $record->symptoms_observed) }}</textarea>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label>Action Taken</label>
        <input type="text" name="action_taken" value="{{ old('action_taken', $record->action_taken) }}" class="form-control" required>
    </div>

    <div class="col-md-4 mb-3">
        <label>Vet Name</label>
        <input type="text" name="vet_name" value="{{ old('vet_name', $record->vet_name) }}" class="form-control">
    </div>

    <div class="col-md-4 mb-3">
        <label>Outcome</label>
        <input type="text" name="outcome" value="{{ old('outcome', $record->outcome) }}" class="form-control">
    </div>
</div>

<div class="text-end">
    <button class="btn btn-primary">
        <i class="fas fa-save"></i> Update Record
    </button>
</div>

</form>

</div>
</div>
</div>
</section>
</div>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#pigSelect').select2({
                placeholder: 'Search pig tag...',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection

