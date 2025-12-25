@extends('layouts.app')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Add Monthly Expense</h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <form method="POST" action="{{ route('monthly_expenses.store') }}">
                    @csrf

                    <div class="card-body">
                        <div class="row">

                            <!-- Year -->
                            <div class="form-group col-md-2">
                                <label>Year <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="year"
                                    class="form-control"
                                    placeholder="e.g. 2025"
                                    value="{{ old('year', date('Y')) }}"
                                    required
                                >
                                <span class="text-danger">{{ $errors->first('year') }}</span>
                            </div>

                            <!-- Month -->
                            <div class="form-group col-md-3">
                                <label>Month <span class="text-danger">*</span></label>
                                <select name="month" class="form-control" required>
                                    <option value="">-- Select Month --</option>
                                    @foreach([
                                        1=>'January', 2=>'February', 3=>'March', 4=>'April',
                                        5=>'May', 6=>'June', 7=>'July', 8=>'August',
                                        9=>'September', 10=>'October', 11=>'November', 12=>'December'
                                    ] as $key => $month)
                                        <option value="{{ $key }}" {{ old('month') == $key ? 'selected' : '' }}>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('month') }}</span>
                            </div>

                            <!-- Opening Balance -->
                            <div class="form-group col-md-3">
                                <label>Opening Balance</label>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="opening_balance"
                                    class="form-control"
                                    placeholder="0.00"
                                    value="{{ old('opening_balance') }}"
                                >
                                <span class="text-danger">{{ $errors->first('opening_balance') }}</span>
                            </div>

                            <!-- Total Spent -->
                            <div class="form-group col-md-2">
                                <label>Total Spent <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="total_spent"
                                    class="form-control"
                                    placeholder="0.00"
                                    value="{{ old('total_spent') }}"
                                    required
                                >
                                <span class="text-danger">{{ $errors->first('total_spent') }}</span>
                            </div>

                            <!-- Closing Balance -->
                            <div class="form-group col-md-2">
                                <label>Closing Balance</label>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="closing_balance"
                                    class="form-control"
                                    placeholder="0.00"
                                    value="{{ old('closing_balance') }}"
                                >
                                <span class="text-danger">{{ $errors->first('closing_balance') }}</span>
                            </div>

                            <!-- Remarks -->
                            <div class="form-group col-md-12">
                                <label>Remarks</label>
                                <textarea
                                    name="remarks"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Optional notes for this month"
                                >{{ old('remarks') }}</textarea>
                                <span class="text-danger">{{ $errors->first('remarks') }}</span>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Save Monthly Expense
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </section>

</div>

@endsection
