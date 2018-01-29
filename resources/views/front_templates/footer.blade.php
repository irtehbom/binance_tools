    <!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Copyright</h4>
            <?php /*<p class="lead mb-0">Designed and maintained by <a rel="nofollow" target="_blank" href="https://www.linkedin.com/in/robert-jones-84ba8249/">Robert Jones</a></p> */ ?>
			<p class="lead mb-0">Binance Tools 2018</a></p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Social</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" target="_blank" href="https://www.facebook.com/binancetools">
                  <i class="fa fa-fw fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" target="_blank" href="#">
                  <i class="fa fa-fw fa-google-plus"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" target="_blank"  href="https://twitter.com/binancetools_">
                  <i class="fa fa-fw fa-twitter"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">About Binance Tools</h4>
            <p class="lead mb-0">Binance tools is currently in beta, we're constantly developing new tools to help with trading.</p>
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Binancetools.com | Binance.com is a registered trademark and is no way associated with Binancetools.com</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Portfolio Modals -->

 


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111300255-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111300255-1');
  
  particlesJS.load('particles-js', '{{ asset('/') }}/js/particles.json', function() {
  console.log('callback - particles.js config loaded');
});
  
</script>


<!-- Bootstrap core JavaScript -->
    <script src="{{ asset('public_theme/') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('public_theme/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('public_theme/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('public_theme/') }}/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ asset('public_theme/') }}/js/jqBootstrapValidation.js"></script>
    <script src="{{ asset('public_theme/') }}/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('public_theme/') }}/js/freelancer.min.js"></script>

  </body>