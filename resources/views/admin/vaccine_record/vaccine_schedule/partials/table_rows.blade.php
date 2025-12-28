@php
    $id = 1;
@endphp

@forelse($records as $record)
    <tr>
        <td>{{ $id++ }}</td>
        
        <td style="min-width: 80px;">
            <span class="badge bg-info">{{ $record->pig->tag_id ?? 'N/A' }}</span>
        </td>
        
        <td style="min-width: 130px;">{{ $record->vaccine_name }}</td>
        
        <td style="min-width: 130px;">{{ $record->age_given }}</td>

        <td style="min-width: 130px;">{{ $record->date_given }}</td>

        <td style="min-width: 130px;">{{ $record->next_due_date }}</td>
        
        <td style="min-width: 150px;" >{{ $record->administered_by }}</td>

        <td style="min-width: 250px;">
            <span class="short-text">
                {{ Str::limit($record->remarks, 40) }}
                @if(strlen($record->remarks) > 40)
                    <a href="javascript:void(0)" class="read-more">Read more</a>
                @endif
            </span>

            <span style="min-width: 200px;" class="full-text d-none">
                {{ $record->remarks }}
                <a href="javascript:void(0)" class="read-less">Read less</a>
            </span>
        </td>
        
        <td style="min-width: 150px;">{{ $record->staff->name ?? '-' }}</td>
        
        <td style="min-width: 130px;">{{ $record->created_at->format('d-m-Y H:i:s') }}</td>

        <td style="min-width: 150px;">{{ $record->editor->name ?? '-' }}</td>

        <td style="min-width: 120px;">
            {{-- <a href="{{ route('vaccine_schedule.view', $record->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i>
            </a> --}}

            <a href="{{ route('vaccine_schedule.edit', $record->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('vaccine_schedule.delete', $record->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm delete">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="100%" class="text-muted py-4">
            No records found
        </td>
    </tr>
@endforelse
