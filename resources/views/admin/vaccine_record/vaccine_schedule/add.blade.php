@extends('layouts.app')
@section('content')
{{-- 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
--}}
<div class="content-wrapper">
   <section class="content-header">
      <h1>Add Vaccine Schedule</h1>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card shadow-sm">
            <div class="card-body">
               <form method="POST" action="{{ route('vaccine_schedule.store') }}">
                  @csrf
                  <div class="row">
                     
                     <div class="col-md-4 mb-3">
                        <label class="fw-bold">Select Pigs</label>
                        <select
                           name="pig_ids[]"
                           id="pigSelect"
                           class="form-control"
                           multiple
                           required
                        >
                           {{-- Select All --}}
                           <option value="__all__">Select All</option>

                           @foreach($pigs as $pig)
                                 <option
                                    value="{{ $pig->id }}"
                                    @if(isset($selectedPigIds) && in_array($pig->id, $selectedPigIds)) selected @endif
                                 >
                                    {{ $pig->tag_id }}
                                 </option>
                           @endforeach
                        </select>
                     </div>

                     

                     <div class="col-md-4 mb-3">
                        <label>Vaccine Name</label>
                        <input type="text" name="vaccine_name" placeholder="Name of vaccine" class="form-control" required>
                     </div>

                     <div class="col-md-4 mb-3">
                        <label>Age Given</label>
                        <input type="text" name="age_given" class="form-control" placeholder="Age of animal" required>
                     </div>

                  </div>


                  <div class="row">
                     <div class="col-md-4 mb-3">
                        <label>Administered By</label>
                        <input type="text" name="administered_by" placeholder="Vet Name" class="form-control" required>
                     </div>

                     <div class="col-md-4 mb-3">
                        <label>Date Given</label>
                        <input type="date" name="date_given" class="form-control" required>
                     </div>
                     
                     <div class="col-md-4 mb-3">
                        <label>Next Due Date</label>
                        <input type="date" name="next_due_date" class="form-control">
                     </div>
                  </div>

                  <div class="mb-3">
                     <label>Remark</label>
                     <textarea name="remarks" rows="2" placeholder="Any additional note" class="form-control" required></textarea>
                  </div>

                  <div class="text-end">
                     <button class="btn btn-success">
                     <i class="fas fa-save"></i> Save Record
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
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <script>
   $(document).ready(function () {

      const SELECT_ALL_VALUE = '__all__';

      $('#pigSelect').select2({
         placeholder: 'Select pigs',
         closeOnSelect: false,
         width: '100%',
         templateResult: formatOption,
         templateSelection: formatSelection
      });

      function formatOption(option) {
         if (!option.id) return option.text;

         return $(`
               <span>
                  <input type="checkbox" style="margin-right:6px;" />
                  ${option.text}
               </span>
         `);
      }

      function formatSelection(option) {
         return option.text;
      }

      // Select All logic
      $('#pigSelect').on('select2:select', function (e) {
         if (e.params.data.id === SELECT_ALL_VALUE) {
               let allValues = [];

               $('#pigSelect option').each(function () {
                  if (this.value !== SELECT_ALL_VALUE) {
                     allValues.push(this.value);
                  }
               });

               $('#pigSelect').val(allValues).trigger('change');
         }
      });

      $('#pigSelect').on('select2:unselect', function (e) {
         if (e.params.data.id === SELECT_ALL_VALUE) {
               $('#pigSelect').val(null).trigger('change');
         }
      });

   });
   </script>
@endsection
