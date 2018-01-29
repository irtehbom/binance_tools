@extends('layouts.app')
@section('content')
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">


<div class="add_button-container">
    <section class="content-header">
        <h1>
            All Users
        </h1>
        
        @if (Session::has('message'))

        <div class="spacer"></div>
        {!! session('message') !!}

        @endif
        
    </section>
    <span class="pull-right"><a href="{{ url('admin/posts/add') }}" class="btn btn-success btn-sm btn-block">Add Post</a></span>
</div>

<div class="box box-primary">
    <div class="box-body">


        <table id="data-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>Number</th>
                    <th>Username</th>
					<th>Email</th>
                    <th>API Set</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
					<th>Number</th>
                    <th>Username</th>
					<th>Email</th>
                    <th>API Set</th>
                    <th>Created at</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $user)
                <tr>
					<td>{{$loop->iteration}}</td>
                    <td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
                    <td>N/A for now</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js "></script>

<script>
$('#data-table').DataTable( {
    responsive: true,
	"pageLength": 250
} );
</script>

@endsection
