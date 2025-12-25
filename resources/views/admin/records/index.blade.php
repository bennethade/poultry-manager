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
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Records for the last 7 days</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <!-- /.col -->
        <div class="col-md-12">

          @include('_message')

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">7 days record</h3>
            </div>
            <!-- /.card-header -->
            {{-- <div class="card-body p-0" style="overflow: auto;"> --}}
            <div class="card-body p-0">
                <div style="overflow: auto; white-space: nowrap;">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="sticky-col" style="min-width:20px;">Recorded At</th>
                                <th style="min-width:110px;">Type</th>
                                <th style="min-width:180px;">Title</th>
                                <th style="min-width:100px;">Quantity</th>
                                <th style="min-width:120px;">Amount</th>
                                <th style="min-width:180px;">Buyer / Party</th>
                                <th style="min-width:350px;">Notes</th>
                                <th style="min-width:100px;">Event Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($records as $row)
                            <tr>
                                <td class="sticky-col">{{ \Carbon\Carbon::parse($row->created_at)->format('d M H:i') }}</td>

                                {{-- <td>{{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}</td> --}}
                                <td>
                                    {{-- <span class="badge {{ $row->record_type == 'sale' ? 'badge-success' : 'badge-danger' }}">
                                        {{ ucfirst($row->record_type) }}
                                    </span> --}}
                                    @php
                                    $colors = [
                                        'sale' => 'badge-success',
                                        'expense' => 'badge-danger',
                                        'farm_record' => 'badge-info',
                                        'farm_daily_care' => 'badge-warning',
                                    ];
                                    @endphp

                                    <span class="badge {{ $colors[$row->record_type] ?? 'badge-secondary' }}">
                                        {{ ucwords(str_replace('_', ' ', $row->record_type)) }}
                                    </span>
                                </td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->quantity ?? '-' }}</td>
                                <td>₦{{ number_format($row->amount, 2) }}</td>
                                <td>{{ $row->party ?? '-' }}</td>
                                {{-- <td>{{ \Illuminate\Support\Str::limit($row->notes, 50) }}</td> --}}


                                <td style="min-width: 350px;">
                                    @php
                                        $fullText = $row->notes;
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



                                <td>{{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

              <div style="padding: 10px; float: right;">
                
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>



@endsection


@section('script')

<!--For SweetAlert2 Library-->
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