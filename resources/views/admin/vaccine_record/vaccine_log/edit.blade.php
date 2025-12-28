@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>Edit Vaccine Log</h1>
   </section>
   <section class="content">
      <form method="POST" action="{{ route('vaccine_log.update',$record->id) }}">
         @csrf
         <div class="card">
            <div class="card-body">
               @include('admin.vaccine_record.vaccine_log.partials.form', ['record'=>$record])
            </div>
            <div class="card-footer text-end">
               <button class="btn btn-primary">Update</button>
            </div>
         </div>
      </form>
   </section>
</div>
@endsection