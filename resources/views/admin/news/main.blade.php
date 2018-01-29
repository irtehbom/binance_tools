@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('/') }}/css/easy-loading.css">
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="{{ asset('/') }}/js/easy-loading.js"></script>

<div class="add_button-container">
    <section class="content-header">
        <h1>
            News From Your Favourites
        </h1>
        @if (Session::has('message'))
        <div class="spacer"></div>
        {!! session('message') !!}

        @endif
    </section>
</div>

<div class="box box-primary">
    <div class="box-body">

        <div class="row">
            <div class="col-lg-12">

                <div class="table-responsive">
                    <table class="table table-condensed" id='data-table'>

                        <thead>
                            <tr>
                                <th>News</th>
                                <th>Market</th>
                                <th>Source</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>News</th>
                                <th>Market</th>
                                <th>Source</th>
                                <th>Created</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                @foreach ($tweets as $tweet) 
                                
                                

                                @php ($market = $tweet['market']) 
                                @unset($tweet['market'])

                                @foreach ($tweet as $tweet_data) 

                                @foreach ($tweet_data as $tweet_text) 
      
                                 <tr>
                                <td>
                                    <a target="_blank" href='https://twitter.com/{{$tweet_text['user']['screen_name']}}/status/{{$tweet_text['id']}}'>{{$tweet_text['text']}}</a>
                                </td>

                                <td>
                                    {{ $market }}
                                </td>
                                <td>
                                    Twitter
                                </td>
                                <td data-order="{{$tweet_text['created_at']}}">
                                    @php($time =  \Carbon\Carbon::parse($tweet_text['created_at'])->diffForHumans() )
                                    <span data-livestamp="{{$tweet_text['created_at']}}">{{$time}}</span>
                                </td>

                                 </tr>

                                @endforeach
                                @endforeach
                                @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>


</div>

</div>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js "></script>

<script>

</script>
<script>


    $(document).ready(function () {
        $('#data-table').DataTable({
            responsive: true,
            "pageLength": 30,
            "order": [[ 3, "desc" ]]
        });
    });
</script>

@endsection

