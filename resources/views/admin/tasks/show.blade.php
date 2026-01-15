@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Task Details</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $task->title }}</h3>

                    <div class="card-tools">
                        @if($task->status == 'pending')
                            <span class="badge badge-danger">Pending</span>
                        @elseif($task->status == 'in_progress')
                            <span class="badge badge-warning">In Progress</span>
                        @else
                            <span class="badge badge-success">Completed</span>
                        @endif
                    </div>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Category</strong><br>
                            {{ $task->category->name }}
                        </div>

                        <div class="col-md-4">
                            <strong>Assigned To</strong><br>
                            {{ $task->assignedUser->name }}
                            {{ $task->assignedUser->last_name }}
                        </div>

                        <div class="col-md-4">
                            <strong>Created By</strong><br>
                            {{ $task->creator->name }}
                            {{ $task->creator->last_name }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Status</strong><br>
                            {{ ucfirst(str_replace('_',' ',$task->status)) }}
                        </div>

                        <div class="col-md-3">
                            <strong>Priority</strong><br>
                            <span class="badge badge-{{ 
                                $task->priority == 'high' ? 'danger' :
                                ($task->priority == 'medium' ? 'warning' : 'secondary')
                            }}">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </div>

                        <div class="col-md-3">
                            <strong>Due Date</strong><br>
                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'Not Set' }}
                        </div>

                        <div class="col-md-3">
                            <strong>Completed At</strong><br>
                            {{ $task->completed_at ? \Carbon\Carbon::parse($task->completed_at)->format('d M Y H:i') : '—' }}
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <strong>Description</strong>
                            <p class="mt-2">
                                {{ $task->description ?? 'No description provided.' }}
                            </p>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-right">

                    @if($task->status == 'pending')
                        <form method="POST" action="{{ route('tasks.start', $task) }}" class="d-inline">
                            @csrf
                            {{-- @method('PATCH') --}}
                            <button class="btn btn-info">
                                <i class="fas fa-play"></i> Start Task
                            </button>
                        </form>
                    @endif

                    @if($task->status == 'in_progress')
                        <form method="GET" action="{{ route('tasks.complete', $task) }}" class="d-inline">
                            @csrf
                            {{-- @method('PATCH') --}}
                            <button class="btn btn-success">
                                <i class="fas fa-check"></i> Mark as Completed
                            </button>
                        </form>
                    @endif

                    @if($task->status == 'pending' || $task->status == 'in_progress')
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    @else
                        <a href="{{ route('tasks.completed_index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Completed Tasks
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </section>
</div>

@endsection
