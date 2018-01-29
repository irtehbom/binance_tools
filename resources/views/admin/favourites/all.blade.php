@extends('layouts.app')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.29.4/css/theme.bootstrap_4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/') }}/css/easy-loading.css">

<div class="add_button-container">
    <section class="content-header">
        <h1>
            Favourites
        </h1>
    </section>
</div>

<div class="box box-primary">
    <div class="box-body">

        <div class="row">
            <div class="col-lg-6">


                @if (Session::has('message'))
                <div class="spacer"></div>
                {!! session('message') !!}

                @endif


                <div id="easy-loading-div">

                    <h3>Recent Orders</h3>

                    @foreach ($decode as $markets)

                    <h4>{{$markets}}</h4>

                    <div class="table-responsive">
                        <table class="table table-condensed mobile-table">

                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Amount Purchased/Sold</th>
                                    <th>Profit/Loss</th>
                                    <th>Purchase/Sell Price</th>
                                    <th>Current Price</th>
                                    <th>Time</th>
                                </tr>
                            </thead>

                            <tbody class="orders-table" id="{{$markets}}">


                            </tbody>
                        </table>
                    </div>

                    @endforeach

                </div>
            </div>

            <div class="col-lg-6">

                <h3>News</h3>

                    <div class="table-responsive">
                <table class="table tablesorter" id="data-table">

                    <thead>
                        <tr>
                            <th>News</th>
                            <th>Market</th>
                            <th>Source</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody class="twitter-table">

                    </tbody>
                </table>


            </div>

            </div>
        </div>
    </div>
</div>



<script src="{{ asset('/') }}/js/easy-loading.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.29.4/js/jquery.tablesorter.combined.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.29.4/js/jquery.tablesorter.widgets.js"></script>


<script>


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

$(document).ready(function () {

    function truncateString(str, length) {
        return str.length > length ? str.substring(0, length - 3) + '' : str
    }

    $.tablesorter.addParser({
        id: "extractYYYYMMDD",
        is: function (s) {
            // don't auto detect this parser
            return false;
        },
        format: function (s, table) {
            var date = s.replace(/\s+/g, " ").replace(/[\-.,]/g, "/").match(/(\d{4}[\/\s]\d{1,2}[\/\s]\d{1,2}(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?)/i);
            if (date) {
                date = date[0].replace(/(\d{4})[\/\s](\d{1,2})[\/\s](\d{1,2})/, "$2/$3/$1");
                return $.tablesorter.formatFloat((new Date(date).getTime() || ''), table) || s;
            }
            return s;
        },
        type: "numeric"
    });

    $('#data-table').tablesorter({
        theme: 'bootstrap 4',
        widgets: [],
        headers: {
            1: {
                sorter: 'extractYYYYMMDD'
            }
        },
        sortList: [
            [3]
        ],
        sortInitialOrder: "desc"
    });

    EasyLoading.show({});

    xhrPool = [];
    var interval;

    var favs = [{!!$fav_data!!}];
    var orders = [];
    var market = '';
    var order = '';

    $.each(favs, function (index, value) {

        var conn = new WebSocket('wss://stream.binance.com:9443/ws/' + value + '@ticker');
        conn.onmessage = function (e) {

            var obj = jQuery.parseJSON(e.data);
            var coinName = obj.s.toLowerCase();


            //selects the correct market
            if (coinName == value) {

                $.each(orders, function (index, value) {

                    var market = value['market_lower'];
                    var market_heigher = value['market_higher'];

                    if (market == coinName) {

                        $('#' + market_heigher + '').empty();
						
						if(value.orders.code != -2014) {

							$.each(value['orders'], function (index, value) {
								
								 var side = value['isBuyer'];
								
								 if (side) {
									var type = 'Buy Order';	 
								 } else {
									var type = 'Sell Order';	 
								 }

									var order = value['price'];
									var amount = value['qty'];
									var date = new Date(value['time']);
									var hours_ago = moment(date).startOf('hour').fromNow();
									var percent = getPercentageChange(order, obj.a);
									$('#' + market_heigher + '').append("<tr><td>" + type + "</td><td>" + amount + "</td><td>" + percent + "</td><td>" + order + "</td><td>" + obj.a + "</td><td>" + hours_ago + "</td></tr>");
							});
						
						} else {
							$('#' + market_heigher + '').append("<tr><td><span style='color:red'>API Key Invalid or Not Set</td><td>N/A</td><td>N/A</td><td>N/A</td>N/A<td>" + obj.a + "</td>N/A<td></td></tr>");
						}

                    }

                });

            }

        };

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    ajax = $.ajax({

        beforeSend: function (jqXHR, settings) {
            xhrPool.push(jqXHR);
        },
        url: "{{ url('/admin/favourites/twitterAjax') }}",
        type: 'post',
        dataType: "json",
        data: {

        },
        success: function (data, status) {

            $(".twitter-table").empty();

            $.each(data, function (index, value) {

                var timedate = value.tweet[1].created_at;
                //var date = moment(timedate).startOf('hour').fromNow();
                var date = moment(timedate).format('MMMM Do YYYY, h:mm:ss a');


                $(".twitter-table").append("<tr><td style='width:300px'><a target='_blank' href='https://twitter.com/" + value.tweet[0].user.screen_name + "/status/" + value.tweet[0].id_str + "'>" + value.tweet[0].text + "</a></td><td>" + value.market + "</td><td>Twitter</td><td>" + date + "</td></tr>");
                $(".twitter-table").append("<tr><td style='width:300px'><a target='_blank' href='https://twitter.com/" + value.tweet[1].user.screen_name + "/status/" + value.tweet[1].id_str  + "'>" + value.tweet[1].text + "</a></td><td>" + value.market + "</td><td>Twitter</td><td>" + date + "</td></tr>");
                $('#data-table').trigger("update");
            });

        },
        error: function (xhr, desc, err) {
            console.log(err);
        }
    }); // end ajax call

    ajax = $.ajax({

        beforeSend: function (jqXHR, settings) {
            xhrPool.push(jqXHR);
        },
        url: "{{ url('/admin/favourites/ordersAjax') }}",
        type: 'post',
        dataType: "json",
        data: {

        },
        success: function (data, status) {

            EasyLoading.hide({});

            orders = data;

        },
        error: function (xhr, desc, err) {

        }
    }); // end ajax call



    setInterval(function () {


        ajax = $.ajax({

            beforeSend: function (jqXHR, settings) {
                xhrPool.push(jqXHR);
            },
            url: "{{ url('/admin/favourites/twitterAjax') }}",
            type: 'post',
            dataType: "json",
            data: {

            },
            success: function (data, status) {

                $(".twitter-table").empty();

                $.each(data, function (index, value) {

                    var timedate = value.tweet[1].created_at;
                    //var date = moment(timedate).startOf('hour').fromNow();
                    var date = moment(timedate).format('MMMM Do YYYY, h:mm:ss a');

                    $(".twitter-table").append("<tr><td style='width:300px'><a target='_blank' href='https://twitter.com/" + value.tweet[0].user.screen_name + "/status/" + value.tweet[0].id_str  + "'>" + value.tweet[0].text + "</a></td><td>" + value.market + "</td><td>Twitter</td><td>" + date + "</td></tr>");
                    $(".twitter-table").append("<tr><td style='width:300px'><a target='_blank' href='https://twitter.com/" + value.tweet[1].user.screen_name + "/status/" + value.tweet[1].id_str  + "'>" + value.tweet[1].text + "</a></td><td>" + value.market + "</td><td>Twitter</td><td>" + date + "</td></tr>");
                    $('#data-table').trigger("update");
                });

            },
            error: function (xhr, desc, err) {
                console.log(err);
            }
        }); // end ajax call
    }, 120000);



});
</script>

@endsection

