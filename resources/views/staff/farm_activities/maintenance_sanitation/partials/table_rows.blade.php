@php
    use Illuminate\Support\Str;

    $id = 1;
    // $id = ($getRecord->currentPage() - 1) * $getRecord->perPage() + 1;
@endphp

@foreach ($records as $value)
<tr>
    <td>{{ $id++ }}</td>
    <td style="min-width: 120px;">{{ date('d-m-Y', strtotime($value->date)) }}</td>
    <td style="min-width: 120px;">{{ $value->activity }}</td>
    <td style="min-width: 150px;">{{ $value->chemicals_tools_used }}</td>
    <td style="min-width: 150px;">{{ $value->area }}</td>

    <td style="min-width: 300px;">
        @php
            $fullText = $value->remarks;
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

    <td style="min-width: 150px;">
        @if($value->staff)
            {{ $value->staff->name }}
            {{ $value->staff->last_name }}
        @endif
    </td>

    <td style="min-width: 130px;">{{ $value->created_at->format('d-m-Y H:i A') }}</td>

    <td style="min-width: 150px;">
        @if($value->editor)
            {{ $value->editor->name }}
            {{ $value->editor->last_name }}
        @endif
    </td>

    {{-- <td style="min-width: 150px;">
        <a href="{{ route('staff.maintenance_sanitation.edit', $value->id) }}" class="btn btn-primary btn-sm">Edit</a>

        <form action="{{ url('staff/general_farm_activity/maintenance_sanitation/delete/'.$value->id) }}"
              method="POST"
              class="d-inline-block delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm delete">
                Delete
            </button>
        </form>
    </td> --}}
</tr>




@endforeach


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