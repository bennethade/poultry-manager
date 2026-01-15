@php
    $id = 1;
@endphp

@forelse($tasks as $task)
    <tr>
        <td>{{ $id++ }}</td>
        <td style="min-width: 200px;">{{ $task->title }}</td>
        <td style="min-width: 150px;">{{ $task->category->name }}</td>
        <td>
            <span class="badge badge-success">{{ ucfirst($task->status) }}</span>
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

        <td style="min-width: 150px;">{{ $task->completed_at ? \Carbon\Carbon::parse($task->completed_at)->format('d-m-Y') : 'N/A' }}</td>
        <td style="min-width: 150px;">{{ $task->completer?->name }} {{ $task->completer?->last_name }}</td>
        <td style="min-width: 150px;">{{ $task->creator->name }} {{ $task->creator->last_name }}</td>

        <td style="min-width: 100px; white-space: nowrap;" class="text-nowrap">
            <a href="{{ route('tasks.show_completed',$task) }}" class="btn btn-sm btn-warning">View</a>

            {{-- <form action="{{ route('tasks.delete', $task) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm delete">
                    <i class="fas fa-trash">Delete</i>
                </button>
            </form> --}}
        </td>

    </tr>

@empty

    <tr>
        <td colspan="10" class="text-left">No tasks found for this query.</td>
    </tr>
@endforelse