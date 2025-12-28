@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>Medication Details</h1>
   </section>
   <section class="content">
      <div class="card">
         <div class="card-body">
            <p><strong>Pig:</strong> {{ $record->pig->tag_id }}</p>
            <p><strong>Date:</strong> {{ $record->date }}</p>
            <p><strong>Drug:</strong> {{ $record->drug_name }}</p>
            <p><strong>Dosage:</strong> {{ $record->dosage }}</p>
            <p><strong>Duration:</strong> {{ $record->duration }}</p>
            <p><strong>Administered By:</strong> {{ $record->administered_by }}</p>
            <p><strong>Remarks:</strong> {{ $record->remarks }}</p>
            <p><strong>Recorded By:</strong> {{ $record->staff->name }}</p>
         </div>
      </div>
   </section>
</div>
@endsection