@extends('layouts.app')

@section('content')
<div class="container">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>age</th>
                <!-- <th>cr</th> -->
                <!-- <th>Start date</th> -->

            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ url('allposts') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "age"
                },
                
            ]

        });
    });
</script>