@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <section class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h4>Task Title: <span style="color: brown">{{ $task->title }}</span></h4>
                </div>

                <div class="col-sm-6 float-right" style="text-align: right;">
                    <h5>Task Category: <span style="color: brown">{{ $task->category->name }}</span></h5> <br>          
                </div>
            </div>

            <div class="row" style="margin: 10px;">

                <form method="POST" action="{{ route('staff.tasks.complete.store',$task) }}" enctype="multipart/form-data">
                    @csrf
                        @include($formView)
                    <button class="btn btn-success">Submit & Complete Task</button>
                </form>
            </div>

        </div>
    </section>
</div>


@endsection