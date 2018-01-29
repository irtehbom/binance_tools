<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Binance Tools</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/dist/css/AdminLTE.min.css">

        <link rel="stylesheet" href="{{ asset('/') }}/css/dashboard_style.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/dist/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/custom_theme_bootstrap_ui/jquery-ui-1.10.3.custom.css">
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/custom_theme_bootstrap_ui/jquery-ui-1.10.3.theme.css">
        <link rel="stylesheet" href="{{ asset('admin_theme/') }}/custom_theme_bootstrap_ui/jquery.ui.1.10.3.ie.css">


        <!-- Styles -->
        <link href="{{ asset('css/back_end/app.css') }}" rel="stylesheet">

        <script src="{{ asset('admin_theme/') }}/bower_components/jquery/dist/jquery.min.js"></script>



        <script>
window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
]) !!}
;

        </script>
    </head>
    <body>

        @if (!Auth::guest())

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>B</b>inance <b>T</b>ools</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>B</b>inance <b>T</b>ools</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            
                            <li class='user-status'>
                                 
                                Days left on subscription <strong>{{Auth::user()->tokens}}</strong>
                            </li>
                            
                             <li class='user-status'>
                                 @php($role = Auth::user()->roles()->first()->name)
                                     {{$role}}
                            </li>
                            

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('admin_theme/') }}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{ asset('admin_theme/') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                        <p>
                                            {{Auth::user()->name}}
                                            <small>Member since {{Auth::user()->created_at->format('l j F Y')}}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">

                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('admin_theme/') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{Auth::user()->name}}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>

                        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-gears"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ url('/admin/profit_tracker') }}"><i class="fa fa-gears"></i> <span>Profit Tracker</span></a></li>
                        <li><a href="{{ url('/admin/favourites') }}"><i class="fa fa-gears"></i> <span>Market Favourites</span></a></li>
                        <li><a href="{{ url('/admin/settings') }}"><i class="fa fa-gears"></i> <span>Settings</span></a></li>
                        
                        

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Orders</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('/admin/orders') }}"><i class="fa fa-gears"></i> <span>All Orders</span></a></li>
                                 <li><a href="{{ url('/admin/orders/add') }}"><i class="fa fa-gears"></i> <span>Create</span></a></li>
                            </ul>
                        </li>
                        
                        


                        <li class="header">Information</li>

                        <li><a href="{{ url('/') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Homepage</span></a></li>
                        
                        
                        @if (Auth::user()->hasRole('Administrator'))
                        

                        <li class="treeview">
                     
                        
                        <li class="header">Administrator</li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Pages</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('/admin/pages/all') }}"><i class="fa fa-circle-o"></i> All Pages</a></li>
                                <li><a href="{{ url('/admin/pages/add') }}"><i class="fa fa-circle-o"></i> Add Pages</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Posts</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('/admin/posts/all') }}"><i class="fa fa-circle-o"></i> All Posts</a></li>
                                <li><a href="{{ url('/admin/posts/add') }}"><i class="fa fa-circle-o"></i> Add Posts</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ url('/admin/users/all') }}"><i class="fa fa-gears"></i> <span>Users</span></a></li>
                        <li><a href="{{ url('/admin/news_settings') }}"><i class="fa fa-gears"></i> <span>News Settings</span></a></li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>File Manager</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('/admin/file_manager_all') }}"><i class="fa fa-circle-o"></i> All Files</a></li>
                                <li><a href="{{ url('/admin/file_manager_add') }}"><i class="fa fa-circle-o"></i> Upload Files</a></li>
                            </ul>
                        </li>

                        @endif

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            @endif

            <div class="content-wrapper">

                <div class="content">

                    @yield('content')

                </div>

            </div>

            <div class="control-sidebar-bg"></div>
			  @if (Auth::user()->hasAnyRole(['Member','Guest','Free Lifetime Member']))

				<div class="row" id="ads-amazon">
	  <div class="col-sm-12">
      <div class="panel panel-success">
        <div class="panel-heading" style="display: table;width: 100%;">
          <h3 class="panel-title pull-left ads-title" style="margin-top:10px">Advertisements</h3>
		  <h3 class="panel-title pull-right ads-remove">Want to remove ads? <a class="ads-button" href="{{ url('/admin/orders/add') }}">Click Here to Upgrade</a></h3>
        </div>
        <div class="panel-body">
		
		<div class="col-sm-3">
			<a class="amazon-link" href="http://amzn.to/2FlsgpS">TREZOR - The Bitcoin Safe</a>
			<a href="http://amzn.to/2FlsgpS"><div class="amazon-image" style="background:url('https://images-na.ssl-images-amazon.com/images/I/410V7xWTsgL.jpg')"></div></a>
        </div>
		
		<div class="col-sm-3">
			<a class="amazon-link" href="http://amzn.to/2DEK3bh">Keepkey - The Simple Bitcoin Hardware Wallet </a>
			<a href="http://amzn.to/2DEK3bh"><div class="amazon-image" style="background:url('https://images-na.ssl-images-amazon.com/images/I/51lvzztzVBL._SL1000_.jpg')"></div></a>
        </div>
		
		<div class="col-sm-3">
			<a class="amazon-link" href="http://amzn.to/2FkY6TD">Ledger Nano S Cryptocurrency Hardware Wallet </a>
			<a href="http://amzn.to/2FkY6TD"><div class="amazon-image" style="background:url('https://images-na.ssl-images-amazon.com/images/I/61zphUPNktL._SL1500_.jpg')"></div></a>
        </div>
		
		<div class="col-sm-3">
			<a class="amazon-link" href="http://amzn.to/2FlsyNu">HyperX Cloud Revolver S Headset</a>
			<a href="http://amzn.to/2FlsyNu"><div class="amazon-image" style="background:url('https://images-na.ssl-images-amazon.com/images/I/71WOvEzVOOL._SL1365_.jpg')"></div></a>
        </div>
		
		</div>
      </div>
      </div>
	</div>
 @endif
            <script
                src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
                integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                                                $.widget.bridge('uibutton', $.ui.button);
            </script>
            <!-- Bootstrap 3.3.7 -->
            <script src="{{ asset('admin_theme/') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- Morris.js charts -->
            <script src="{{ asset('admin_theme/') }}/bower_components/raphael/raphael.min.js"></script>
            <script src="{{ asset('admin_theme/') }}/bower_components/morris.js/morris.min.js"></script>
            <!-- Sparkline -->
            <script src="{{ asset('admin_theme/') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
            <!-- jvectormap -->
            <script src="{{ asset('admin_theme/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="{{ asset('admin_theme/') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
            <!-- jQuery Knob Chart -->
            <script src="{{ asset('admin_theme/') }}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
            <!-- daterangepicker -->
            <script src="{{ asset('admin_theme/') }}/bower_components/moment/min/moment.min.js"></script>
            <script src="{{ asset('admin_theme/') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
            <!-- datepicker -->
            <script src="{{ asset('admin_theme/') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
            <!-- Bootstrap WYSIHTML5 -->
            <script src="{{ asset('admin_theme/') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
            <!-- Slimscroll -->
            <script src="{{ asset('admin_theme/') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="{{ asset('admin_theme/') }}/bower_components/fastclick/lib/fastclick.js"></script>
            <!-- AdminLTE App -->
            <script src="{{ asset('admin_theme/') }}/dist/js/adminlte.min.js"></script>
<div id="amzn-assoc-ad-cf5e9a32-6961-48a0-91df-4441d0d93e46"></div><script async src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US&adInstanceId=cf5e9a32-6961-48a0-91df-4441d0d93e46"></script>



            <script>

                                                $(document).ready(function () {
													
													$('#ads-amazon').appendTo('.content');
													
                                                    /** add active class and stay opened when selected */
                                                    var url = window.location;

                                                    $('ul.sidebar-menu a').filter(function () {
                                                        return this.href == url;
                                                    }).parent().addClass('active');

                                                    $('ul.treeview-menu a').filter(function () {
                                                        return this.href == url;
                                                    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

                                                });

            </script>

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111300255-1"></script>
            <script>
                                                            window.dataLayer = window.dataLayer || [];
                                                            function gtag() {
                                                                dataLayer.push(arguments);
                                                            }
                                                            gtag('js', new Date());

                                                            gtag('config', 'UA-111300255-1');
            </script>

    </body>
</html>
