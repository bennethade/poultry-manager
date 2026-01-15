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
    
    <td style="min-width: 350px;">
        @php
            $fullText = $record->remarks;
            $shortText = Str::limit($fullText, 100);
        @endphp

        <span class="short-text">
            {{ $shortText }}
            @if (strlen($fullText) > 100)
                <a href="javascript:void(0)" class="read-more text-primary">[keep reading]</a>
            @endif
        </span>

        <span class="full-text d-none">
            {{ $fullText }}
            <a href="javascript:void(0)" class="read-less text-danger">[read less]</a>
        </span>
    </td>    
    
    <td style="min-width: 150px;">{{ $record->staff->name ?? '-' }} {{ $record->staff?->last_name }}</td>

    <td style="min-width: 150px;">{{ $record->created_at }}</td>

    <td style="min-width: 150px;">{{ $record->editor->name ?? '-' }} {{ $record->editor?->last_name }}</td>

    <td style="min-width: 150px;">

        <a href="{{ route('staff.medication_treatment.more_record',$record->id) }}" class="btn btn-secondary btn-sm">
            More Record
        </a>

        {{-- <a href="{{ route('staff.medication_treatment.edit',$record->id) }}" title="Edit" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i>
        </a> --}}

        {{-- <form method="POST" action="{{ route('staff.medication_treatment.delete',$record->id) }}" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm delete">
                <i class="fas fa-trash"></i>
            </button>
        </form> --}}
    </td>
</tr>
@empty
<tr>
    <td colspan="100%" class="text-muted py-4">
        No records found
    </td>
</tr>
@endforelse




@section('script')

<script>
    document.addEventListener('click', function (e) {
            if (e.target.classList.contains('read-more')) {
                const td = e.target.closest('td');
                td.querySelector('.short-text').classList.add('d-none');
                td.querySelector('.full-text').classList.remove('d-none');
            }

            if (e.target.classList.contains('read-less')) {
                const td = e.target.closest('td');
                td.querySelector('.full-text').classList.add('d-none');
                td.querySelector('.short-text').classList.remove('d-none');
            }
        });
</script>

@endsection
