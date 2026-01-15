<?php

namespace App\Http\Controllers;

use App\Models\BreedingRecord;
use App\Models\Pig;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskPayload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        
        $data['categories'] = TaskCategory::orderBy('name', 'asc')->get();

        $data['header_title'] = 'Task Management';

        if(Auth::user()->user_type == 2)
        {
            $tasks = Task::with('category', 'assignedUser', 'creator', 'editor')
                // ->where('assigned_to', auth()->id())
                ->whereIn('status', ['pending','in_progress'])
                ->orderBy('created_at', 'desc')
                ->paginate(100);
                
            return view('staff.tasks.index', compact('tasks'), $data);
        }
        else{
            $tasks = Task::with('category', 'assignedUser', 'creator', 'editor')
                ->whereIn('status', ['pending','in_progress'])
                ->orderBy('created_at', 'desc')
                ->paginate(100);
                
            return view('admin.tasks.index', compact('tasks'), $data);
        }
    }


    public function create()
    {
        $data['header_title'] = 'Create Task';

        return view('admin.tasks.create', [
            'categories' => TaskCategory::orderBy('name', 'asc')->get(),
            'users' => User::where('user_type', 2)->orderBy('name', 'asc')->get(),
        ], $data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:task_categories,id',
            'assigned_to'   => 'required|exists:users,id',
            'priority'      => 'required|in:low,medium,high',
            'due_date'      => 'nullable|date',
        ]);

        Task::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'category_id'   => $request->category_id,
            'assigned_to'   => $request->assigned_to,
            'priority'      => $request->priority,
            'due_date'      => $request->due_date,
            'status'        => 'pending',
            'staff_id'      => Auth::id(),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully');
    }


    public function edit($id)
    {
        $data['header_title'] = 'Edit Task';

        $data['task'] = Task::with('payload')->find($id);

        return view('admin.tasks.edit', [
            'categories' => TaskCategory::orderBy('name', 'asc')->get(),
            'users' => User::where('user_type', 2)->orderBy('name', 'asc')->get(),
        ], $data);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:task_categories,id',
            'assigned_to'   => 'required|exists:users,id',
            'priority'      => 'required|in:low,medium,high',
            'due_date'      => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'category_id'   => $request->category_id,
            'assigned_to'   => $request->assigned_to,
            'priority'      => $request->priority,
            'due_date'      => $request->due_date,
            'updated_by'    => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }


    public function show(Task $task)
    {
        $task->load(['category', 'assignedUser', 'creator', 'editor', 'payload']);

        $data['header_title'] = 'View Task';

        // $task = Task::with(['category', 'assignedUser', 'creator', 'editor', 'payload'])->find($task->id);

        if(Auth::user()->user_type == 2)
        {
            return view('staff.tasks.show', compact('task'), $data);
        }
        else{
            return view('admin.tasks.show', compact('task'), $data);
        }
    }



    public function start(Task $task)
    {
        $task->update(['status' => 'in_progress']);
        return back()->with('success', 'Task started successfully');
    }

    public function complete(Task $task)
    {
        $data['header_title'] = 'Complete Task';

        $data['sows'] = Pig::where('sex', 'Female')->orderBy('tag_id', 'asc')->get();
        $data['boars'] = Pig::where('sex', 'Male')->orderBy('tag_id', 'asc')->get();
        $data['pigs'] = Pig::orderBy('tag_id', 'asc')->get();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.tasks.complete', [
                'task' => $task,
                'formView' => 'staff.' . $task->category->form_view
            ], $data);
        }
        else{
            return view('admin.tasks.complete', [
                'task' => $task,
                'formView' => 'admin.' . $task->category->form_view
            ], $data);
        }
    }






    public function storeCompletion(Request $request, Task $task)
    {
        DB::transaction(function () use ($task, $request) {

            // 1️⃣ Save raw payload (excluding files)
            TaskPayload::create([
                'task_id' => $task->id,
                'payload' => collect($request->except('_token'))
                            ->except(array_keys($request->allFiles()))
            ]);

            // 2️⃣ Prepare data
            $data = $request->except('_token');

            // 3️⃣ Handle file uploads (PUBLIC UPLOAD)
            foreach ($request->allFiles() as $field => $file) {

                if ($file->isValid()) {

                    // Ensure folder exists
                    $uploadPath = public_path('upload/' . $task->category->upload_path);

                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }

                    // Generate filename
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Move file
                    $file->move($uploadPath, $filename);

                    // Save relative path in DB
                    $data[$field] = $filename;
                }
            }

            // 4️⃣ System fields
            $data['staff_id']   = Auth::id();
            $data['created_at'] = now();
            $data['updated_at'] = now();

            // 5️⃣ Insert into category table
            DB::table($task->category->table_name)->insert($data);

            // 6️⃣ Mark task completed
            $task->update([
                'status'       => 'completed',
                'completed_at' => now(),
                'completed_by' => Auth::id()
            ]);
        });

        if(Auth::user()->user_type == 2){
            return redirect()->route('staff.tasks.index')->with('success', 'Task completed successfully');
        }
        else{
            return redirect()->route('tasks.index')->with('success', 'Task completed successfully');
        }
    }





    public function delete(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('warning', 'Task deleted successfully');
    }




    public function search(Request $request)
    {
        $search = trim($request->title);

        $tasks = Task::with(['category','assignedUser','creator'])
            ->where('status', '!=', 'completed') // GLOBAL FILTER

            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {

                    // Title
                    $query->where('title', 'like', "%{$search}%")

                    // Description
                    ->orWhere('description', 'like', "%{$search}%")

                    // Priority
                    ->orWhere('priority', 'like', "%{$search}%")

                    // Due date
                    ->orWhere('due_date', 'like', "%{$search}%")

                    // Category
                    ->orWhereHas('category', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%");
                    })

                    // Assigned User
                    ->orWhereHas('assignedUser', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                    })

                    // Creator
                    ->orWhereHas('creator', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                    });

                });
            })

            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })

            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })

            ->orderBy('created_at','desc')
            ->limit(100)
            ->get();

        return view('admin.tasks.partials.task_rows', compact('tasks'));
    }



    public function staffTaskSearch(Request $request)
    {
        $search = trim($request->title);

        $tasks = Task::with(['category','assignedUser','creator'])
            ->where('assigned_to', Auth::id())
            ->where('status', '!=', 'completed') // GLOBAL FILTER

            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {

                    // Title
                    $query->where('title', 'like', "%{$search}%")

                    // Description
                    ->orWhere('description', 'like', "%{$search}%")

                    // Priority
                    ->orWhere('priority', 'like', "%{$search}%")

                    // Due date
                    ->orWhere('due_date', 'like', "%{$search}%")

                    // Category
                    ->orWhereHas('category', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%");
                    })

                    // Assigned user
                    ->orWhereHas('assignedUser', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                    })

                    // Creator
                    ->orWhereHas('creator', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                    });
                });
            })

            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })

            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })

            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        return view('staff.tasks.partials.task_rows', compact('tasks'));
    }





    public function completedIndex()
    {
        $tasks = Task::with('category', 'assignedUser', 'creator', 'editor')
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        $data['categories'] = TaskCategory::orderBy('name', 'asc')->get();

        $data['header_title'] = 'Task Management';
        if(Auth::user()->user_type == 2)
        {
            return view('staff.tasks.completed', compact('tasks'), $data);
        }
        else{
            return view('admin.tasks.completed', compact('tasks'), $data);
        }
    }



    public function searchCompleted(Request $request)
    {
        $search = trim($request->title);

        $tasks = Task::with(['category','assignedUser','creator'])
            ->where('assigned_to', auth()->id())
            ->where('status', 'completed')

            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })

            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {

                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('priority', 'like', "%{$search}%")
                        ->orWhere('due_date', 'like', "%{$search}%")

                        ->orWhereHas('category', function ($u) use ($search) {
                            $u->where('name', 'like', "%{$search}%");
                        })

                        ->orWhereHas('assignedUser', function ($u) use ($search) {
                            $u->where('name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        })

                        ->orWhereHas('creator', function ($u) use ($search) {
                            $u->where('name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                });
            })

            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.tasks.partials.completed_task_rows', compact('tasks'));
        }
        else{
            return view('admin.tasks.partials.completed_task_rows', compact('tasks'));
        }
    }



    //FOR ADMIN ONLY - VIEW ALL TASKS ASSIGNED TO SELF
    public function myToDoIndex()
    {
        $tasks = Task::with('category', 'assignedUser', 'creator', 'editor')
            ->where('assigned_to', auth()->id())
            ->whereIn('status', ['pending','in_progress'])
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        $data['categories'] = TaskCategory::orderBy('name', 'asc')->get();

        $data['header_title'] = 'Task Management';
        return view('admin.tasks.index', compact('tasks'), $data);
    }










}
