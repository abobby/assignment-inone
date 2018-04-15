@extends('layout.default')
@section('title', 'Member List')
@section('content')

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">Members List</h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped" id="members-table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageScript')
<script type="text/javascript">
$(function() {
    $('#members-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{!! route('members.data') !!}',
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endsection