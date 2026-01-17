    @php
        $id = 1;
        // $id = ($getRecord->currentPage() - 1) * $getRecord->perPage() + 1;
    @endphp

    @foreach ($getRecord as $value)
        <tr>
            <td>{{ $id++ }}</td>
            
            <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->formulation_date)) }}</td>
            <td style="min-width: 200px;">{{ $value->feed_stage }}</td>
            <td style="min-width: 200px;">{{ $value->ingredients_used }}</td>
            <td style="min-width: 70px;">{{ $value->quantity }}</td>
            <td style="min-width: 100px;">{{ $value->cost }}</td>
            <td style="min-width: 120px;">{{ $value->total_output }}</td>


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



            <td style="min-width: 150px;">{{ $value->staff->name }} {{ $value->staff->last_name }} {{ $value->staff->other_name }}</td>

            <td style="min-width: 150px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>

            <td style="min-width: 150px;">{{ $value->editor?->name }} {{ $value->editor?->last_name }} {{ $value->editor?->other_name }}</td>

            <td style="min-width: 150px;">
                <a href="{{ route('staff.feed_formulation.more_record', [$value->id]) }}" class="btn btn-secondary btn-sm">More Record</a>

                {{-- <a href="{{ route('staff.feed_formulation.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a> --}}

                {{-- <form action="{{ url('staff/feed_record/feed_formulation/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                </form> --}}
                
            </td>
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