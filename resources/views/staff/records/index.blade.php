@extends('layouts.app')

@section('content')

<style>
    .sticky-col {
        position: sticky;
        left: 0;
        background: #fff;
        z-index: 2;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Quick Record View</h1>
                </div>
            </div>

            <!-- Date Range Form -->
            <div class="row mb-2">
              <div class="col-12">
                  <form method="GET" action="{{ route('weekly_records.view') }}" class="mb-3">
                      <div class="row g-2 align-items-end">

                          <div class="col-12 col-md-4">
                              <label for="start_date">Start Date:</label>
                              <input type="date" name="start_date" id="start_date"
                                    value="{{ $startDateInput ?? $startDate->format('Y-m-d') }}"
                                    class="form-control">
                          </div>

                          <div class="col-12 col-md-4">
                              <label for="end_date">End Date:</label>
                              <input type="date" name="end_date" id="end_date"
                                    value="{{ $endDateInput ?? $endDate->format('Y-m-d') }}"
                                    class="form-control">
                          </div>

                          <div class="col-12 col-md-4">
                              <button type="submit" class="btn btn-primary w-100 mb-1">
                                  Search
                              </button>
                              <a href="{{ route('weekly_records.view') }}" class="btn btn-warning w-100">
                                  Reset
                              </a>
                          </div>

                      </div>
                  </form>
              </div>
          </div>


        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Records</h3>
                        </div>

                        <div class="card-body p-0">
                            <div style="overflow: auto; white-space: nowrap;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="sticky-col" style="min-width:20px;">Recorded At</th>
                                            <th style="min-width:110px;">Category</th>
                                            <th style="min-width:180px;">Title</th>
                                            <th style="min-width:100px;">Quantity</th>
                                            <th style="min-width:120px;">Amount</th>
                                            <th style="min-width:180px;">Buyer / Party</th>
                                            <th style="min-width:350px;">Notes</th>
                                            <th style="min-width:100px;">Event Date</th>
                                            <th style="min-width:120px;">More Info 1</th>
                                            <th style="min-width:120px;">More Info 2</th>
                                            <th style="min-width:120px;">More Info 3</th>
                                            <th style="min-width:120px;">More Info 4</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($records as $row)
                                        <tr>
                                            <td class="sticky-col">{{ \Carbon\Carbon::parse($row->created_at)->format('d M H:i') }}</td>
                                            
                                            <td>
                                                @php
                                                $colors = [
                                                    'sale' => 'badge-success',
                                                    'expense' => 'badge-danger',
                                                    'farm_record' => 'badge-info',
                                                    'farm_daily_care' => 'badge-warning',
                                                    'farm_inventory' => 'badge-info',
                                                    'pig' => 'badge-primary',
                                                    'breeding_record' => 'badge-secondary',
                                                    'growth_record' => 'badge-dark',
                                                    'feed_stock' => 'badge-info',
                                                    'feed_usage' => 'badge-warning',
                                                    'feed_formulation' => 'badge-success',
                                                    'monthly_expense' => 'badge-danger',
                                                    'monthly_sale' => 'badge-primary',
                                                    'maintenance_sanitation' => 'badge-secondary',
                                                    'disease_incidence' => 'badge-dark',
                                                    'medication_treatment' => 'badge-info',
                                                    'vaccine_schedule' => 'badge-warning',
                                                    'vaccine_log' => 'badge-success',
                                                    'heating_record' => 'badge-warning',

                                                ];
                                                @endphp
                                                <span class="badge {{ $colors[$row->record_type] ?? 'badge-secondary' }}">
                                                    {{ ucwords(str_replace('_', ' ', $row->record_type)) }}
                                                </span>
                                            </td>

                                            <td>{{ $row->title ?? '-' }}</td>
                                            <td>{{ $row->quantity ?? '-' }}</td>
                                            <td>₦{{ number_format($row->amount ?? 0, 2) }}</td>
                                            <td>{{ $row->party ?? '-' }}</td>

                                            <td style="min-width: 350px;">
                                                @php
                                                    $fullText = $row->notes ?? '';
                                                    $shortText = Str::limit($fullText, 30);
                                                @endphp

                                                <span class="short-text">
                                                    {{ $shortText }}
                                                    @if (strlen($fullText) > 30)
                                                        <a href="javascript:void(0)" class="read-more text-primary">[read more]</a>
                                                    @endif
                                                </span>

                                                <span class="full-text d-none">
                                                    {{ $fullText }}
                                                    <a href="javascript:void(0)" class="read-less text-danger">[less]</a>
                                                </span>
                                            </td>

                                            <td>{{ $row->date ? \Carbon\Carbon::parse($row->date)->format('d M Y') : '-' }}</td>
                                            <td>{{ $row->extra_1 ?? '-' }}</td>
                                            <td>{{ $row->extra_2 ?? '-' }}</td>
                                            <td>{{ $row->extra_3 ?? '-' }}</td>
                                            <td>{{ $row->extra_4 ?? '-' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="100%" class="">No records found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 10px; float: right;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('read-more')) {
            const td = e.target.closest('td');
            td.querySelector('.short-text').classList.add('d-none');
            td.querySelector('.full-text').classList.remove('d-none');
        }
        if (e.target.classList.contains('read-less')) {
            const td = e.target.closest('td');
            td.querySelector('.full-text').classList.add('d-none');
            td.querySelector('.short-text').classList.remove('d-none');
        }
    });
  </script>
@endsection
