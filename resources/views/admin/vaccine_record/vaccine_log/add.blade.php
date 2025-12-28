@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>Add Vaccine Log</h1>
   </section>
   <section class="content">
      <form method="POST" action="{{ route('vaccine_log.store') }}">
         @csrf
         <div class="card">
            
            <div class="card-body">
               @include('admin.vaccine_record.vaccine_log.partials.form')
            </div>

            <div class="card-footer text-end">
               <button class="btn btn-success">Save</button>
            </div>
         </div>
      </form>
   </section>
</div>
@endsection