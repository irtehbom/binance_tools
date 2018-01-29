@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<link rel="stylesheet" href="{{ asset('/') }}/css/easy-loading.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="{{ asset('/') }}/js/easy-loading.js"></script>

<div class="add_button-container">
    <section class="content-header">
        <h1>
            Profit Tracker
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

            <div class="col-sm-4 market-spacer">
                <div class="form-group" style="display:inline">
                    <label for="market_eth">ETH Market: Total Markets <font style="color:blue"></font></label>
                    <select class="form-control market" class="market" id="market_eth" data-live-search="true">
                        @foreach ($markets as $value)
                        @if($value['market'] == 'eth')
                        @foreach ($value['pairs'] as $value)

                        <option value="{{$value}}">{{$value}}</option>

                        @endforeach
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-sm-4 market-spacer">
                <div class="form-group" style="display:inline">
                    <label for="market">BTC Market: Total Markets <font style="color:blue"></font></label>
                    <select class="form-control market" id="market_btc" data-live-search="true">
                        @foreach ($markets as $value)
                        @if($value['market'] == 'btc')
                        @foreach ($value['pairs'] as $value)

                        <option value="{{$value}}">{{$value}}</option>

                        @endforeach
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-4 market-spacer">
                <div class="form-group" style="display:inline">
                    <label for="market_eth">BNB Markets: Total Markets <font style="color:blue"></font></label>
                    <select class="form-control market" id="market_bnb" data-live-search="true">
                        @foreach ($markets as $value)
                        @if($value['market'] == 'bnb')
                        @foreach ($value['pairs'] as $value)

                        <option value="{{$value}}">{{$value}}</option>

                        @endforeach
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

    </div>
</div>


<div class="box box-primary">
    <div class="box-body">

        <div class="spacer"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>

                                <th>Market</th>
                                <th>Type</th>
                                <th>Amount Purchased/Sold</th>
                                <th>Profit/Loss</th>
                                <th>Purchase/Sell Price</th>
                                <th>Current Price</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody id="order-table">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>




<script>

var market = '';
xhrPool = [];
var conn;

function getPercentageChange(oldNumber, newNumber) {
    var decreaseValue = oldNumber - newNumber;
    var round = (decreaseValue / oldNumber) * 100 - 0.1;
    var percent = round.toFixed(2).toString();

    if (oldNumber > newNumber) {

        var formated_percent = '<span style="color:red">' + percent + '%</span>'

    } else {
		var percent = percent.substring(1);
        var formated_percent = '<span style="color:green">' + percent + '%</span>'
    }
    return formated_percent;
}

function get_data() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ajax = $.ajax({

        beforeSend: function (jqXHR, settings) {
            xhrPool.push(jqXHR);
        },
        url: "{{ url('/admin/profit_tracker') }}",
        type: 'post',
        dataType: "json",
        data: {
            'market': market
        },
        success: function (data, status) {
            
            
            if (typeof conn != 'undefined') {
                conn.close();
            }

            var market_lower = market.toLowerCase();

            conn = new WebSocket('wss://stream.binance.com:9443/ws/' + market_lower + '@ticker');
            conn.onmessage = function (e) {

                var obj = jQuery.parseJSON(e.data);

                $('#order-table').empty();

                $.each(data, function (index, value) {

                    var market_higher = value.market_higher;
                    var order = value.order;
                    var amount = value.qty;
                    var type = value.type;
                    var date = value.date;
                    var hours_ago = value.date;

                    var percent = getPercentageChange(order, obj.a);

                    $('#order-table').append("<tr><td>" + market_higher + "</td><td>" + type + "</td><td>" + amount + "</td><td>" + percent + "</td><td>" + order + "</td><td>" + obj.a + "</td><td>" + hours_ago + "</td></tr>");

                });
            }

            EasyLoading.hide();

        },
        error: function (xhr, desc, err) {

            console.log(err);
        }
    }); // end ajax call


}



$('.market').on('change', function () {

    market = $(this).find(":selected").val();

    $.each(xhrPool, function (idx, jqXHR) {
        jqXHR.abort();
    });
    $("#order-table").empty();
    EasyLoading.show();
    get_data();

});


$(document).ready(function () {
    $('.market').selectpicker();

});
</script>

@endsection

