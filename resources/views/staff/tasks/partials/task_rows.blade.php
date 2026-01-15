@php
    $id = 1;
@endphp

@forelse($tasks as $task)
    <tr>
        <td>{{ $id++ }}</td>
        <td style="min-width: 200px;">{{ $task->title }}</td>
        <td style="min-width: 150px;">{{ $task->category->name }}</td>
        <td>
            @if($task->status == 'pending')
                <span class="badge badge-danger">{{ ucfirst($task->status) }}</span>
            @elseif($task->status == 'in_progress')
                <span class="badge badge-warning">{{ ucfirst($task->status) }}</span>
            @endif
        </td>
        <td style="min-width: 100px;">
            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') : 'N/A' }}
        </td>
        <td style="min-width: 150px;">{{ $task->assignedUser->name }} {{ $task->assignedUser->last_name }}</td>
        
        <td>
            @if ($task->priority == 'high')
                <span class="badge badge-danger">High</span>
            @elseif ($task->priority == 'medium')
                <span class="badge badge-warning">Medium</span>
            @else
                <span class="badge badge-secondary">Low</span>                                                
            @endif
        </td>

        <td style="min-width: 150px;">{{ date($task->created_at->format('d-m-Y')) }}</td>
        <td style="min-width: 150px;">{{ $task->creator->name }} {{ $task->creator->last_name }}</td>

        <td style="min-width: 200px; white-space: nowrap;" class="text-nowrap">
            @if ($task->assigned_to === Auth::id())
                @if($task->status == 'pending')
                    <form method="POST" action="{{ route('staff.tasks.start',$task) }}" style="display:inline;">
                        @csrf
                        <button class="btn btn-sm btn-secondary">Start</button>
                    </form>
                @elseif($task->status == 'in_progress')
                    <a href="{{ route('staff.tasks.complete',$task) }}" class="btn btn-sm btn-success">Complete</a>
                @endif
            @else
                
            @endif

            <a href="{{ route('staff.tasks.show',$task) }}" class="btn btn-sm btn-warning">View</a>
            
        </td>

    </tr>

@empty

    <tr>
        <td colspan="10" class="text-left">No tasks found for this query.</td>
    </tr>
@endforelse