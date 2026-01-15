    @php
        use Illuminate\Support\Str;

        $id = 1
    @endphp

 


    @foreach ($getRecord as $value)
        <tr>
            <td>{{ $id++ }}</td>
            
            <td style="min-width: 100px;"><span class="badge badge-info">{{ $value->pig?->tag_id }}</span></td>
            {{-- <td style="min-width: 200px;">{{ $value->item_type }}</td> --}}
            <td style="min-width: 100px;">{{ $value->reason }}</td>
            <td style="min-width: 100px;">{{ $value->quantity }}</td>
            <td style="min-width: 150px;">₦{{ number_format($value->price, 2) }}</td>

            <td style="min-width: 150px;">
                @if ($value->sold_on_discount == 1)
                    Yes
                @else
                    No
                @endif
            </td>
            <td style="min-width: 150px;">₦{{ number_format($value->discounted_price,2) }}</td>
            <td style="min-width: 150px;">{{ $value->buyer_name }}</td>
            <td style="min-width: 150px;">{{ $value->buyer_phone }}</td>
            <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date)) }}</td>

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
                    <a href="{{ asset('upload/sales/' . $value->picture) }}" target="_blank">
                        <img 
                            src="{{ asset('upload/sales/' . $value->picture) }}" 
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
                <a href="{{ route('sales.view', [$value->id]) }}" class="btn btn-warning btn-sm">View</a>
                
                <a href="{{ route('sales.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ url('admin/sales_record/daily_sales/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
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
