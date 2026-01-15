@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <h1>Edit Task</h1>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card card-primary">
            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
               @csrf
               <div class="card-body">
                  <div class="row">
                     {{-- Task Title --}}
                     <div class="form-group col-md-7">
                        <label>Task Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" placeholder="Enter task title" class="form-control"
                           value="{{ old('title', $task->title) }}" required>
                        <small class="text-danger">{{ $errors->first('title') }}</small>
                     </div>

                     {{-- Category --}}
                     <div class="form-group col-md-5">
                        <label>Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                           <option value="">-- Select Category --</option>
                           @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $task->category->id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                           @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('category_id') }}</small>
                     </div>

                     {{-- Priority --}}
                     <div class="form-group col-md-4">
                        <label>Priority</label>
                        <select name="priority" class="form-control">
                           <option {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }} value="low">Low</option>
                           <option {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }} value="medium">Medium</option>
                           <option {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }} value="high">High</option>
                        </select>
                     </div>

                     {{-- Assign To --}}
                     <div class="form-group col-md-4">
                        <label>Assign To <span class="text-danger">*</span></label>
                        <select name="assigned_to" class="form-control" required>
                           <option value="">-- Select User --</option>
                           @foreach($users as $user)
                            <option {{ old('assigned_to', $task->assignee->id) == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</option>
                           @endforeach
                        </select>
                     </div>

                     {{-- Due Date --}}
                     <div class="form-group col-md-4">
                        <label>Due Date</label>
                        <input type="date" name="due_date" class="form-control"
                           value="{{ old('due_date', $task->due_date) }}">
                     </div>

                     {{-- Description --}}
                     <div class="form-group col-md-12">
                        <label>Task Description</label>
                        <textarea name="description" rows="2" placeholder="Enter task description" class="form-control">{{ old('description', $task->description) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Update
                  </button>
               </div>
            </form>
         </div>
      </div>
   </section>
</div>
@endsection