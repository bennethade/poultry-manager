@php
    $id = 1;
@endphp

@forelse($records as $record)
    <tr>
        <td>{{ $id++ }}</td>
        
        <td style="min-width: 130px;">{{ $record->date }}</td>

        <td style="min-width: 80px;">
            <span class="badge bg-info">{{ $record->pig->tag_id ?? 'N/A' }}</span>
        </td>

        <td style="min-width: 200px;" class="fw-bold text-danger">{{ $record->suspected_disease }}</td>

        <td style="min-width: 250px;">
            <span class="short-text">
                {{ Str::limit($record->symptoms_observed, 40) }}
                @if(strlen($record->symptoms_observed) > 40)
                    <a href="javascript:void(0)" class="read-more">Read more</a>
                @endif
            </span>

            <span style="min-width: 200px;" class="full-text d-none">
                {{ $record->symptoms_observed }}
                <a href="javascript:void(0)" class="read-less">Read less</a>
            </span>
        </td>

        <td style="min-width: 200px;">{{ $record->action_taken }}</td>

        <td style="min-width: 250px;">
            @if($record->outcome)
                <span class="badge bg-success">{{ $record->outcome }}</span>
            @else
                <span class="badge bg-secondary">Pending</span>
            @endif
        </td>

        <td style="min-width: 150px;">{{ $record->vet_name }}</td>
        
        <td style="min-width: 150px;">
            {{ $record->staff?->name }}
            {{ $record->staff?->last_name }}
        </td>
        
        <td style="min-width: 130px;">{{ $record->created_at->format('d-m-Y H:i:s') }}</td>

        <td style="min-width: 150px;">
            {{ $record->editor?->name }}
            {{ $record->editor?->last_name }}
        </td>

        <td style="min-width: 120px;">
            {{-- <a href="{{ route('disease_incidence.view', $record->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i>
            </a> --}}

            <a href="{{ route('disease_incidence.edit', $record->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('disease_incidence.delete', $record->id) }}" method="POST" class="d-inline">
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
        <td colspan="8" class="text-center text-muted py-4">
            No records found
        </td>
    </tr>
@endforelse
