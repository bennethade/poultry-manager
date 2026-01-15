@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>Add Medication</h1>
   </section>
   <section class="content">
      <form method="POST" action="{{ route('staff.medication_treatment.store') }}">
         @csrf
         <div class="card">
            
            <div class="card-body">
               @include('staff.disease_treatment.medication_treatment.partials.form')
            </div>

            <div class="card-footer text-end">
               <button class="btn btn-success">Save</button>
            </div>
         </div>
      </form>
   </section>
</div>
@endsection