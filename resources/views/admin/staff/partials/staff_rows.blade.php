    @php
    $id = 1
    @endphp

    @foreach ($getRecord as $value)
    <tr>
        <td>{{ $id++ }}</td>
        <td>
        @if (!empty($value->getProfileDirect()))
            <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
        @endif
        
        </td>
        <td style="min-width: 150px;">{{ $value->name }} {{ $value->last_name }}</td>
        <td>{{ $value->email }}</td>
        <td>{{ $value->gender }}</td>
        <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date_of_birth)) }}</td>
        <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->admission_date)) }}</td>
        <td>{{ $value->mobile_number }}</td>
        <td>{{ $value->marital_status }}</td>
        <td>{{ $value->address }}</td>
        <td>{{ $value->permanent_address }}</td>
        <td>{{ $value->qualification }}</td>
        <td>{{ $value->work_experience }}</td>
        <td>{{ $value->note }}</td>
        <td>{{ ($value->status == 0) ? 'Active' :'Inactive' }}</td>
        <td>{{ $value->keep_track }}</td>
        <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
        <td style="min-width: 200px;">
        <a href="{{ route('staff.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

        <form action="{{ url('admin/staff/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
        </form>

        {{-- <a href="{{ url('admin/staff/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
        {{-- <a href="{{ url('chat?receiver_id=/'.base64_encode($value->id)) }}" class="btn btn-success btn-sm">Send Message</a> --}}
        </td>
    </tr>
    @endforeach



    @section('scripts')
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