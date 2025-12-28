    @php
        use Illuminate\Support\Str;

        $id = 1
    @endphp

 


    @foreach ($getRecord as $value)
        <tr>
            <td>{{ $id++ }}</td>
            
            <td style="min-width: 200px;">{{ $value->care_type }}</td>
            <td style="min-width: 100px;">{{ $value->quantity }}</td>
            <td style="min-width: 150px;">{{ $value->house_or_unit }}</td>
            <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date)) }}</td>
            {{-- <td style="min-width: 350px">{{ Str::limit($value->notes, 100) }}</td> --}}

            <td style="min-width: 350px;">
                @php
                    $fullText = $value->notes;
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



            <td>
                @if (!empty($value->picture))
                    <a href="{{ asset('upload/farm_daily_cares/' . $value->picture) }}" target="_blank">
                        <img 
                            src="{{ asset('upload/farm_daily_cares/' . $value->picture) }}" 
                            alt="Picture" 
                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;"
                        >
                    </a>
                @endif
            </td>



            <td style="min-width: 150px;">{{ $value->staff_name }} {{ $value->last_name }} {{ $value->other_name }}</td>

            <td style="min-width: 150px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>

            <td style="min-width: 150px;">{{ $value->updated_by_name }} {{ $value->updated_by_last_name }} {{ $value->updated_by_other_name }}</td>

            <td style="min-width: 200px;">
                <a href="{{ route('farm_daily_care.view', [$value->id]) }}" class="btn btn-warning btn-sm">View</a>
                
                <a href="{{ route('farm_daily_care.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ url('admin/general_farm_activity/farm_daily_care/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                </form>

                
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
