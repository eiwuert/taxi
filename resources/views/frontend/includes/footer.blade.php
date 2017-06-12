<footer class="footer-small footer-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 pull-right">
                    <ul class="social-link-footer list-unstyled">
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".6s"><a href="https://www.instagram.com/flipapplication/"><i class="fa fa-instagram"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".2s"><a href="flipapp96@gmail.com"><i class="fa fa-google-plus"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".8s"><a href="https://t.me/flipapp"><i class="fa fa-paper-plane"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="https://www.facebook.com/profile.php?id=100016712433417"><i class="fa fa-facebook"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".4s"><a href="https://www.linkedin.com/in/flip-application-63abb5141"><i class="fa fa-linkedin"></i></a></li>
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".5s"><a href="https://twitter.com/flipapp96"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="copyright">
                        <p>&copy; ۲۰۱۷ | پیاده سازی توسط
                            <a href="{{ url('global') }}" target="_blank">
                                <span>تیم توسعه فلیپ</span>
                            </a>
                            |
                            <a href="{{ url('global/terms') }}" style="color: #ea6459">
                                <span>قوانین و مقررات</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--small footer end-->
    <!-- js placed at the end of the document so the pages load faster
   -->
    <script src="{{ mix('js/fa.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/js/superfish.min.js"></script>
    <!-- end of sequence slider js-->
    <script type="text/javascript">
    jQuery(document).ready(function() {


        $('.bxslider1').bxSlider({
            minSlides: 5,
            maxSlides: 6,
            slideWidth: 360,
            slideMargin: 2,
            moveSlides: 1,
            responsive: true,
            nextSelector: '#slider-next',
            prevSelector: '#slider-prev',
            nextText: 'Onward →',
            prevText: '← Go back'
        });

    });
    </script>
    <script>
    $('a.info').tooltip();
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });

    $(document).ready(function() {

        $("#owl-demo").owlCarousel({

            items: 4

        });

    });

    jQuery(document).ready(function() {
        jQuery('ul.superfish').superfish();
        new WOW().init();
    });

    </script>
</body>

</html>