@php
    $id = 1;
@endphp

@forelse($records as $record)
<tr>
    <td>{{ $id++ }}</td>
    <td style="min-width: 100px;">{{ $record->date }}</td>
    <td style="min-width: 70px;"><span class="badge bg-info">{{ $record->pig->tag_id }}</span></td>
    <td style="min-width: 200px;" class="fw-bold">{{ $record->drug_name }}</td>
    <td style="min-width: 200px;">{{ $record->dosage }}</td>
    <td style="min-width: 200px;">{{ $record->duration }}</td>
    <td style="min-width: 200px;">{{ $record->administered_by ?? '-' }}</td>
    
    <td style="min-width: 300px;">{{ Str::limit($record->remarks, 100) }}</td>
    
    
    <td style="min-width: 150px;">{{ $record->staff->name ?? '-' }} {{ $record->staff?->last_name }}</td>

    <td style="min-width: 150px;">{{ $record->created_at }}</td>

    <td style="min-width: 150px;">{{ $record->editor->name ?? '-' }} {{ $record->editor?->last_name }}</td>

    <td style="min-width: 120px;">
        <a href="{{ route('medication_treatment.edit',$record->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i>
        </a>

        <form method="POST" action="{{ route('medication_treatment.delete',$record->id) }}" class="d-inline">
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
