@extends('layouts.app')

@section('content')


<div class="add_button-container">
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>
</div>

<div class="box box-primary">
    <div class="box-body">
       <div class="row">
            <div class="col-sm-12">
				<h2>Welcome to Binance Tools {{Auth::user()->name}}, the app is currently in BETA.</h2><br>
				
				In order to use our tool(s) set you will need to create an API key or input your existing ones. All data on this website is tripple encrypted so rest assured your details are safe.
				<br><br>
				Like the crypto market, we are still developing and improving. We will be adding new features and launching new tools in the future, as well as adding content on the basics of trading, so check back often to see what we add, or click on Suggest Features to send us your own ideas. If it’s beneficial and we can do it, we will incorporate the changes in an upcoming version.
				<br><br>
            </div>
        </div>
    </div>
</div>

@endsection
