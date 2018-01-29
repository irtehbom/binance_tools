@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@section('content')



<div class="add_button-container">
    <section class="content-header">
        <h1>
            User Settings
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
            <div class="col-sm-12">
                <div class="alert alert-default">
                    <strong>All your information is encrypted, including your API Key and API Secret key for your security. </strong>
                    <br><br>
                    Your API is required to pull back YOUR information on our trading tools. Without it, the tools simply won't work.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer"></div>

<div class="box box-primary">
    <div class="box-body">

        <div class="spacer"></div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#api">API Settings</a></li>
            <li><a data-toggle="tab" href="#favourites">Favourites</a></li>
        </ul>

        <div class="spacer"></div>

        <div class="tab-content">
            <div id="api" class="tab-pane fade in active">


                <div class="row">
                    <div class="col-sm-12">
                        <strong>Create your API key by visiting this <a target="_blank" href="https://www.binance.com/userCenter/createApi.html">link</a></strong>
                    </div>
                </div>

                <div class="spacer"></div>

                <form method="POST" id="form-validate" name="form-validate" action="{{ url('/admin/settings') }}">

                    <div class="input-group">
                        <span class="input-group-addon" style="min-width: 90px">API Key</span>
                        <div class="encrypted"><i class="fa fa-lock" aria-hidden="true"></i> <span class="encrypted-style">Encrypted</span></div>
                        <input id="email" style="border-color:green;" type="password" class="form-control" name="api_key" placeholder="API Key" value="{{ $api_key}}">

                    </div>

                    <div class="spacer"></div>

                    <div class="input-group">
                        <span class="input-group-addon" style="min-width: 90px">API Secret</span>
                        <div class="encrypted"><i class="fa fa-lock" aria-hidden="true"></i> <span class="encrypted-style">Encrypted</span></div>
                        <input id="password" style="border-color:green;" type="password" class="form-control" name="api_secret" placeholder="API Secret" value="{{ $api_secret }}">
                    </div>

                    <div class="spacer"></div>

                    <div class="spacer"></div>

                    <button type="submit" class="btn btn-success  pull-left">Save API Settings</button>

                    {{ csrf_field() }}

                </form>

            </div>

            <div id="favourites" class="tab-pane fade in">

                <form method="POST" id="form-validate" name="form-validate" action="{{ url('/admin/favourites/save') }}">

                    <div class="row">

                        <div class="col-sm-4 market-spacer">
                            <div class="form-group" style="display:inline">
                                <label for="market_eth">ETH Markets: </label>
                                <select class="form-control market" class="market" id="market_eth" data-live-search="true" multiple data-max-options="5" name="eth[]">

                                    @foreach ($markets as $value)
                                    @if($value['market'] == 'eth')
                                    @foreach ($value['pairs'] as $value)
                                    
                                    @if(isset($favourites))
                                    @if (in_array($value,$favourites)) 
                                    <option selected  value="{{$value}}">{{$value}}</option>
                                    @else
                                    <option value="{{$value}}">{{$value}}</option>
                                    @endif

                                    @else
                                    
                                    <option value="{{$value}}">{{$value}}</option>
                                    
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-4 market-spacer">
                            <div class="form-group" style="display:inline">
                                <label for="market">BTC Markets: </label>
                                <select class="form-control market" id="market_btc" data-live-search="true" multiple data-max-options="5" name="btc[]">
                                    @foreach ($markets as $value)
                                    @if($value['market'] == 'btc')
                                    @foreach ($value['pairs'] as $value)
                                    
                                    @if(isset($favourites))
                                    @if (in_array($value,$favourites)) 
                                    <option selected  value="{{$value}}">{{$value}}</option>
                                    @else
                                    <option value="{{$value}}">{{$value}}</option>
                                    @endif

                                    @else
                                    
                                    <option value="{{$value}}">{{$value}}</option>
                                    
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4 market-spacer">
                            <div class="form-group" style="display:inline">
                                <label for="market_eth">BNB Markets</label>
                                <select class="form-control market" id="market_bnb" data-live-search="true" multiple data-max-options="5" name="bnb[]">
                                    @foreach ($markets as $value)
                                    @if($value['market'] == 'bnb')
                                    @foreach ($value['pairs'] as $value)
                                    
                                    @if(isset($favourites))
                                    @if (in_array($value,$favourites)) 
                                    <option selected  value="{{$value}}">{{$value}}</option>
                                    @else
                                    <option value="{{$value}}">{{$value}}</option>
                                    @endif

                                    @else
                                    
                                    <option value="{{$value}}">{{$value}}</option>
                                    
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>


                     
<div class="spacer"></div>

                    <div class="spacer"></div>

                       <button type="submit" class="btn btn-success  pull-left">Save Favourites</button>

                    {{ csrf_field() }}

                </form>


            </div>

        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<script>
$(document).ready(function () {



    $('.market').selectpicker();

    var selected = [];

    $('.market').on('change', function (e) {

        $(".market option:selected").each(function () {

            var found = jQuery.inArray(this, selected);
            if (found >= 0) {
                selected.splice(found, 1);
            } else {
                if ($(selected).length < 6) {
                    selected.push(this);
                } else {
                    $('.market').selectpicker('deselectAll');
                    $('.market').selectpicker('refresh');
                    alert('Please only select 5 pairs, your selected options have been reset');
                }
            }
        });

    });
});
</script>

@endsection
