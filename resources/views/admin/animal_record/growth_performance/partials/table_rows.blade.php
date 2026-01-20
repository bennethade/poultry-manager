@php 
    $id = 1;
    // $id = ($records->currentPage() - 1) * $records->perPage() + 1;
@endphp
@foreach($records as $record)
    <tr>
        <td>{{ $id++ }}</td>
        <td style="min-width: 100px;">{{ $record->pig->tag_id }}</td>
        <td style="min-width: 120px;">{{ $record->measurement_date }}</td>
        <td style="min-width: 100px;">{{ $record->age_in_days }}</td>
        <td style="min-width: 100px;">{{ $record->age_in_weeks }}</td>
        <td style="min-width: 100px;">{{ $record->weight }}</td>
        <td style="min-width: 200px;">{{ $record->feed_type }}</td>
        <td style="min-width: 250px;">{{ $record->remarks }}</td>
        <td style="min-width: 150px;">{{ $record->staff?->name }} {{ $record->staff?->last_name }}</td>
        <td style="min-width: 100px;">{{ $record->created_at }}</td>
        <td style="min-width: 150px;">{{ $record->editor?->name }} {{ $record->editor?->last_name }}</td>
        <td style="min-width: 250px;">
            <a href="{{ route('growth_performance.more_record', [$record->id]) }}" class="btn btn-secondary btn-sm">More Record</a>                                        
            <a href="{{ route('growth_performance.edit', [$record->id]) }}" class="btn btn-primary btn-sm">Edit</a>
            <form action="{{ url('admin/animal_record/growth_performance/delete/'.$record->id) }}" method="POST" class="d-inline-block delete-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-danger delete">Delete</button>
            </form>
        </td>
    </tr>
@endforeach


@section('script')

    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete this record?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

@endsection