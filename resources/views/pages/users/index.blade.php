@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table id="users" class="table pmc-table">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


@endsection
@section('page-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#users').DataTable({
            ajax: "",
            processing: true,
            serverSide: true,
            language: {
                url: "{{asset('themes/vendors/datatables/pl.json')}}"
            },
            columns: [
                {data: 'firstname', name: 'firstname'},
                {data: 'lastname', name: 'lastname'},
                {data: 'email', name: 'lastname'},
                {data: 'action', name: 'action', searchable:false, orderable:false},
            ]
        });
    })
</script>
@endsection