@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<link rel="stylesheet" href="{{ asset('/') }}/css/easy-loading.css">
<script src="{{ asset('/') }}/js/easy-loading.js"></script>

<div class="add_button-container">
    <section class="content-header">
        <h1>
            News Settings
        </h1>
        @if (Session::has('message'))
        <div class="spacer"></div>
        {!! session('message') !!}

        @endif
    </section>
</div>


        <div class="row">
            <div class="col-lg-12">

                <form method="POST" id="form-validate" name="form-validate" action="{{ url('/admin/news_settings') }}">

                    <div class="box box-primary">
                        <div class="box-body">

                            {{ csrf_field() }}


                            <div class="spacer"></div>


                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#twitter">Twitter</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="twitter" class="tab-pane fade in active">

                                    <h4 class="spacer title-spacer">Twitter Usernames</h4>
                                    
                                    @foreach ($markets as $market)

                                    <div class="spacer"></div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            {{$market}}
                                        </div>
                                        <input class="form-control inline" name="{{$market}}" id="{{$market}}" value="{{$twitter->$market}}" placeholder="" type="text"/>
                                    </div>
                                    
                                    @endforeach
                                    
                                </div>

                               <div class="spacer"></div>

                            <button type="submit" class="btn btn-success btn-lg btn-block">Save Twitter</button>
                            <div class="spacer"></div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
</div>

</div>


<script>


$(document).ready(function () {

});
</script>

@endsection

