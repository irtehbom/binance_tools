@extends('layouts.app')
@section('content')
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">


<div class="add_button-container">
    <section class="content-header">
        <h1>
            Packages
        </h1>

        @if (Session::has('message'))

        <div class="spacer"></div>
        {!! session('message') !!}

        @endif

    </section>

</div>


<div class="box box-primary">
    <div class="box-body">

        <div class="spacer-large"></div>

        <div class="package-container">

            <div class="col-lg-3">

                <div class='package'>
                    <div class='name'>Free</div>
                    <hr>
                    <ul>
                        <li class="tick">
                            <strong>Access</strong> to Profit Tracker
                        </li>
                        <li class="cross">
                            <strong>Access</strong> to Market Favorites
                        </li>
                        <li class="cross">
                            Free From <strong>Ads</strong>
                        </li>

                    </ul>
                </div>
            </div>
            
            <div class="col-lg-3">

                <div class='package brilliant'>

                    <form method="POST" id="form-validate" name="form-validate" action="{{ url('/admin/free_trial') }}">
                        
                        {{ csrf_field() }}


                        <div class='name'>Free Trial</div>
                        <div class='price'>7 Days Free Trial</div>
                        <hr>

                        <div class="package-body">

                            <ul>
                                <li class="tick">
                                    <strong>Access</strong> to Profit Tracker
                                </li>
                                <li class="tick">
                                    <strong>Access</strong> to Market Favorites
                                </li>
                                <li class="tick">
                                    Free From <strong>Ads</strong>
                                </li>
                            </ul>

                        </div>

                        <hr>


                        <button type="submit" class="btn btn-success btn-lg btn-block">Start Your Free Trial</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-3">

                <div class='package brilliant'>

                    <form method="POST" id="form-validate" name="form-validate" action="{{ url('/admin/payment/30') }}">
                        
                        {{ csrf_field() }}


                        <div class='name'>Monthly</div>
                        <div class='price'>€5 / Month</div>
                        <hr>

                        <div class="package-body">

                            <ul>
                                <li class="tick">
                                    <strong>Access</strong> to Profit Tracker
                                </li>
                                <li class="tick">
                                    <strong>Access</strong> to Market Favorites
                                </li>
                                <li class="tick">
                                    Free From <strong>Ads</strong>
                                </li>
                            </ul>

                        </div>

                        <hr>


                        <button type="submit" class="btn btn-success btn-lg btn-block">Purchase with Crypto</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-3">

                <div class='package brilliant'>

                    <form method="POST" id="form-validate" name="form-validate" action="{{ url('/admin/payment/360') }}">
                        
                        {{ csrf_field() }}


                        <div class='name'>Yearly</div>
                        <div class='price'>€42 / Year</div>
                        <hr>

                        <div class="package-body">

                            <ul>
                                <li class="tick">
                                    <strong>30%</strong> Off
                                </li>
                                <li class="tick">
                                    <strong>Access</strong> to Profit Tracker
                                </li>
                                <li class="tick">
                                    <strong>Access</strong> to Market Favorites
                                </li>
                                <li class="tick">
                                    Free From <strong>Ads</strong>
                                </li>
                            </ul>
                        </div>

                        <hr>


                        <button type="submit" class="btn btn-success btn-lg btn-block">Purchase with Crypto</button>

                    </form>

                </div>
            </div>
        </div>
        <div class="spacer-large"></div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js "></script>

<script>
$('#data-table').DataTable({
    responsive: true
});
</script>

@endsection
