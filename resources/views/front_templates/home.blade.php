@include('front_templates/header')

<script src="{{ asset('/') }}/js/particles.min.js"></script>

<!-- Header -->
<header class="masthead bg-primary text-white text-center" id="particles-js">
    <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="/storage/app/public/logo.png" alt="">
        <h1 class="text-uppercase mb-0">Welcome</h1>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Binance Tools is currently in BETA</h2>
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light"  href="{{ url('register') }}">
                <i class="fa fa-download mr-2"></i>
                Register Now For Free
            </a>
        </div>
    </div>
</header>

<!-- Portfolio Grid Section -->
<section class="portfolio" id="portfolio">
    <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Our Tools</h2>
        <hr class="star-dark mb-5">
        <div class="row">
            <div class="col-md-6 col-lg-4">

                <h3 class="text-secondary text-uppercase mb-0">Profit Tracker</h3>
                <hr class="dark mb-5">

                <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-1">
                    <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                        <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>

                    <img style="z-index:20" class="img-fluid" src="/storage/app/public/profit_tracker.png" alt="">
                </a>
            </div>

            <div class="col-md-6 col-lg-4">

                <h3 class="text-secondary text-uppercase mb-0">Market Favourites</h3>
                <hr class="dark mb-5">

                <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-2">
                    <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                        <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>

                    <img style="z-index:20" class="img-fluid" src="/storage/app/public/market_favourites.png" alt="">
                </a>
            </div>
        </div>



    </div>
</div>
</section>

<!-- About Section -->
<section class="bg-primary text-white mb-0" id="about">
    <div class="container">
        <h2 class="text-center text-uppercase text-white">About</h2>
        <hr class="star-light mb-5">
        <div class="row">
            <div class="col-lg-12 ml-auto">
                <p class="lead">

                    Binance is one of the largest cryptocurrency exchanges. It has an ever expanding list of crypto pairings, and their software is constantly upgrading to include additional features. 
                    While it has excellent charts and lots of historical information on prices through their exchange, one area where the software is lacking is in displaying the potential profit and loss of each trade that you conduct. 

                    <br><br>
                    We have developed Binance Tools as a way of tracking the performance of your trades. You can view opening and closing trades for any chosen currency pair. With open trades, you can use this to figure out the level of profit or loss that you currently face.

                    <br><br>

                    Like the crypto market, we are still developing and improving. We will be adding new features and launching new tools in the future, as well as adding content on the basics of trading, so check back often to see what we add. If it’s beneficial and we can do it, we will incorporate the changes in an upcoming version.



                </p>
            </div>

        </div>
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light"  href="{{ url('register') }}">
                <i class="fa fa-download mr-2"></i>
                Register Now For Free
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Stats</h2>
        <hr class="star-dark mb-5">
        <div class="row">
           

            <div class="spacer"></div>

            <div class="col-lg-10 mx-auto" style="text-align:center">

                <a href="https://uk.trustpilot.com/review/binancetools.com" class="trust_pilot" target="_blank"><img src="/storage/app/public/trustpilot.jpg"></a>
            </div>

        </div>
    </div>
</section>

<!-- Portfolio Modal 1 -->
<div class="portfolio-modal mfp-hide" id="portfolio-modal-1">
    <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
            <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="text-secondary text-uppercase mb-0">Profit Tracker</h2>
                    <hr class="star-dark mb-5">
                    <img class="img-fluid mb-5" src="/storage/app/public/profit_tracker.png" alt="">
                    <p class="mb-5"><div class="text-center mt-4">
                        <a class="btn btn-xl btn-outline-dark"  href="{{ url('register') }}">
                            <i class="fa fa-download mr-2"></i>
                            Register Now For Free
                        </a>
                    </div></p>
                    <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                        <i class="fa fa-close"></i>
                        Close</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-modal mfp-hide" id="portfolio-modal-2">
    <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
            <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="text-secondary text-uppercase mb-0">Market Favourites</h2>
                    <hr class="star-dark mb-5">
                    <img class="img-fluid mb-5" src="/storage/app/public/market_favourites.png" alt="">
                    <p class="mb-5"><div class="text-center mt-4">
                        <a class="btn btn-xl btn-outline-dark"  href="{{ url('register') }}">
                            <i class="fa fa-download mr-2"></i>
                            Register Now For Free
                        </a>
                    </div></p>
                    <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                        <i class="fa fa-close"></i>
                        Close</a>
                </div>
            </div>
        </div>
    </div>
</div>




@include('front_templates/footer')

