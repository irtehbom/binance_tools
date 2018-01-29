@extends('layouts.app')
@section('content')
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">


<div class="add_button-container">
    <section class="content-header">
        <h1>
            All Pages
        </h1>
        
        @if (Session::has('message'))

        <div class="spacer"></div>
        {!! session('message') !!}

        @endif
        
    </section>
    <span class="pull-right"><a href="{{ url('admin/pages/add') }}" class="btn btn-success btn-sm btn-block">Add Page</a></span>
</div>

<div class="box box-primary">
    <div class="box-body">


        <table id="data-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Page Name</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Page Name</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($all as $object)
                <tr>
                    <td><a href="{{ url('admin/pages/edit/') }}/{{ $object->id }}">{{ $object->title }} </a>

                        @if ($object->homepage == 1)

                        [ Homepage ]

                        @endif

                    </td>
                    <td>{{ $object->meta_title }}</td>
                    <td>{{ $object->meta_description }}</td>
                    <td>
                        <a href="{{ url('admin/pages/edit/') }}/{{ $object->id }}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('admin/pages/delete/') }}/{{ $object->id }}">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
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
    responsive: true
} );
</script>

@endsection
