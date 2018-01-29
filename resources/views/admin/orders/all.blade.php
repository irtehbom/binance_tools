@extends('layouts.app')
@section('content')
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">


<div class="add_button-container">
    <section class="content-header">
        <h1>
            All Orders
        </h1>
        
        @if (Session::has('message'))

        <div class="spacer"></div>
        {!! session('message') !!}

        @endif
        
    </section>
    <span class="pull-right"><a href="{{ url('admin/orders/add') }}" class="btn btn-success btn-sm btn-block">Create Order</a></span>
</div>

<div class="box box-primary">
    <div class="box-body">

<div class="table-responsive">
        <table  class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                   <th>Days Purchased</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Days Purchased</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($orders as $object)
                <tr>
                    <td>
                         {{$object->tokens - 1}} Days
                    </td>
                     <td>
                        €{{$object->total_price}}
                    </td>
                    
                     <td>
                        {{$object->status}}
                    </td>
                    
                     <td>
                        {{$object->updated_at}}
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
		</div>
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
