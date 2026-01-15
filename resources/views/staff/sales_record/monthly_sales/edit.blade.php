@extends('layouts.app')

@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Monthly Sales</h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <form method="POST" action="{{ route('staff.monthly_sales.update', $getRecord->id) }}">
                    @csrf
                    {{-- @method('PUT') --}}

                    <div class="card-body">
                        <div class="row">

                            <!-- Year -->
                            <div class="form-group col-md-2">
                                <label>Year <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="year"
                                    class="form-control"
                                    value="{{ old('year', $getRecord->year) }}"
                                    required readonly
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
                                        <option value="{{ $key }}"
                                            {{ old('month', $getRecord->month) == $key ? 'selected' : '' }}>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('month') }}</span>
                            </div>

                            <!-- Opening Balance -->
                            <div class="form-group col-md-3">
                                <label>Total Sales</label>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="total_sales"
                                    class="form-control"
                                    value="{{ old('total_sales', $getRecord->total_sales) }}"
                                >
                                <span class="text-danger">{{ $errors->first('total_sales') }}</span>
                            </div>

                            <!-- Total Spent -->
                            <div class="form-group col-md-2">
                                <label>Total Expense <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="total_expense"
                                    class="form-control"
                                    value="{{ old('total_expense', $getRecord->total_expense) }}"
                                    required
                                >
                                <span class="text-danger">{{ $errors->first('total_expense') }}</span>
                            </div>

                            <!-- Closing Balance -->
                            <div class="form-group col-md-2">
                                <label>Gross Profit</label>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="gross_profit"
                                    class="form-control"
                                    value="{{ old('gross_profit', $getRecord->gross_profit) }}"
                                >
                                <span class="text-danger">{{ $errors->first('gross_profit') }}</span>
                            </div>

                            <!-- Remarks -->
                            <div class="form-group col-md-12">
                                <label>Remarks</label>
                                <textarea
                                    name="remarks"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Optional notes for this month"
                                >{{ old('remarks', $getRecord->remarks) }}</textarea>
                                <span class="text-danger">{{ $errors->first('remarks') }}</span>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Update Monthly Sales
                        </button>
                        <a href="{{ route('staff.monthly_sales.list') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </section>

</div>

@endsection
