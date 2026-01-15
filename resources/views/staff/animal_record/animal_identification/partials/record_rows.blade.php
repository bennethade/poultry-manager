    @php
        use Illuminate\Support\Str;

        $id =1;
        // $id = ($getRecord->currentPage() - 1) * $getRecord->perPage() + 1;
    @endphp

 


    @foreach ($getRecord as $value)
        <tr>
            <td>{{ $id++ }}</td>
            
            <td style="min-width: 100px;"> <span class="badge bg-info">{{ $value->tag_id }}</span></td>
            <td style="min-width: 100px;">{{ $value->breed }}</td>
            <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->dob)) }}</td>
            <td style="min-width: 50px;">
                @if ($value->sex == 'Male')
                    Boar
                @else
                    Sow
                @endif
            </td>
            <td style="min-width: 100px;">{{ $value->stage }}</td>
            <td style="min-width: 100px;">{{ $value->source }}</td>
            <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date_entry)) }}</td>
            <td style="min-width: 100px;">{{ $value->initial_weight }}</td>
            <td style="min-width: 100px;">{{ $value->current_weight }}</td>
            <td style="min-width: 100px;">{{ $value->production_stage }}</td>
            <td style="min-width: 100px;">
                @if ($value->status == 1)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-warning">Inactive</span>
                @endif
            </td>

            <td style="min-width: 350px;">
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



            {{-- <td>
                @if (!empty($value->picture))
                    <a href="{{ asset('upload/animal_identifications/' . $value->picture) }}" target="_blank">
                        <img 
                            src="{{ asset('upload/animal_identifications/' . $value->picture) }}" 
                            alt="Picture" 
                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;"
                        >
                    </a>
                @endif
            </td> --}}



            <td style="min-width: 150px;">{{ $value->staff_name }} {{ $value->last_name }} {{ $value->other_name }}</td>

            <td style="min-width: 150px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>

            <td style="min-width: 150px;">{{ $value->updated_by_name }} {{ $value->updated_by_last_name }} {{ $value->updated_by_other_name }}</td>

            {{-- <td style="min-width: 150px;">
                
                <a href="{{ route('staff.animal_identification.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ url('admin/animal_record/animal_identification/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
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
