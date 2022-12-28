<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $details_restaurant[0]['MP_Name']; ?> | Restaurant</title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php 
        $MP_Desc = strip_tags($details_restaurant[0]['MP_Desc']);
    ?>
    <meta name="description" content="<?= mb_substr($MP_Desc, 0, 180); ?>" />
    <!-- master stylesheet -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css?v=120721.0">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/responsive.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/favicon/favicon-16x16.png" sizes="16x16">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-65124562-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-65124562-2');
    </script>
  
</head>

<body>
    <div class="boxed_wrapper">

        <!-- <div class="preloader"></div> -->

        <!-- Start Top Bar style1 -->
        <section class="top-bar-style1" style="padding: 19px 0 26px;">
        </section>
        <!-- End Top Bar style1 -->

        <!--Start Main Header-->
        <header class="main-header header-style1">

            <div class="header-upper-style1">
                <div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="inner-container clearfix" style="max-width: 100%;">
                                <div class="logo-box-style1 float-left">
                                    <a href="<?= base_url(); ?>">
                                        <img src="<?= base_url(); ?>assets/images/resources/logo.png" alt="Oglinginches Logo" style="width:100%;">
                                    </a>
                                </div>
                                <div class="main-menu-box float-right">
                                    <nav class="main-menu clearfix">
                                        <div class="navbar-header clearfix">
                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        </div>
                                        <div class="navbar-collapse collapse clearfix">
                                            <ul class="navigation clearfix">
                                                <li><a href="<?= base_url(); ?>">Home</a></li>
                                                <li><a href="<?= base_url(); ?>about-us">About</a></li>
                                                <li><a href="<?= base_url(); ?>residential-interior">Residential</a></li>
                                                <li><a href="<?= base_url(); ?>restaurant-design">Restaurant</a></li>
                                                <li><a href="<?= base_url(); ?>commercial-interior">Commercial</a></li>
                                                <li><a href="<?= base_url(); ?>architecture">Architecture</a></li>
                                                <li><a href="<?= base_url(); ?>contact-us">Contact</a></li>
                                                <li><a href="<?= base_url(); ?>blog">Blog</a></li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <div class="mainmenu-right">
                                        <div class="outer-search-box">
                                            <div class="seach-toggle"><i class="fa fa-search"></i></div>
                                            <ul class="search-box">
                                                <li>
                                                    <form method="post" action="<?= base_url(); ?>">
                                                        <div class="form-group">
                                                            <input type="search" name="search" placeholder="Search Here" required>
                                                            <button type="submit"><i class="fa fa-search"></i></button>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-lower-style1">
                <div class="container-fluid" style="padding: 0px 12px;">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="inner-content clearfix">
                                <ul class="header-contact-info float-left">
                                    <li>
                                        <div class="single-item">
                                            <div class="icon">
                                                <span class="icon-maps-and-location"></span>
                                            </div>
                                            <div class="text">
                                                <h3>Maharashtra, Pune</h3>
                                                <p>Marigold, Row House # 2, Lane 8, Veerbhadra Nagar</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-item">
                                            <div class="icon">
                                                <span class="icon-phone"></span>
                                            </div>
                                            <div class="text">
                                                <h3>+91 950 30 33775</h3>
                                                <p>Mon - Sat: 10 Am to 7 Pm</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-item">
                                            <div class="icon">
                                                <span class="icon-mail"></span>
                                            </div>
                                            <div class="text">
                                                <h3>Support@oglinginches.com</h3>
                                                <p>Get a Free Quote</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="header-social-links-style1 float-right">
                                    <li class="wow slideInUp" data-wow-delay="0ms" data-wow-duration="1200ms">
                                        <a title="facebook" href="https://www.facebook.com/oglinginches"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <a title="twitter" href="https://twitter.com/prashantkulsh"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a title="instagram" href="https://www.instagram.com/oglinginches/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--End Main Header-->

<section class="single-post-info-area" style="padding: 3rem 0rem 2rem 0rem !important;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="single-post-info-content text-center">
                    <h1 class="blog-title"><?= $details_restaurant[0]['MP_Name']; ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Single Post Info Area-->

<!--Start blog single area-->
<section id="blog-area" class="blog-single-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="blog-post">
                    <div class="single-blog-post">
                        <div class="blog-single-image-with-text-box">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <?php
                                        $mpid = $details_restaurant[0]['MP_Id'];
                                        $sql1 = "select * from mov_portfolio_images where MP_Id = '$mpid'";
                                        $r1 = $this->db->query($sql1);
                                        $t = $r1->result();
                                        foreach ($t as $valuemg) {
                                            // print_r($valuemg->MP_Id);
                                        ?>
                                            <div class="col-lg-4" style="margin-bottom: 30px;">
                                                <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/<?php echo $valuemg->MPI_Images; ?>" alt="Awesome Image" style="height: 240px;">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="text-box text-justify">
                                        <?= $details_restaurant[0]['MP_Desc']; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <p style="font-size: 20px;line-height: 1.8;">
                                        Year: <?= $details_restaurant[0]['pYear']; ?></p>
                                    <p style="font-size: 20px;line-height: 1.8;">
                                        Budget: <?= $details_restaurant[0]['pBudget']; ?></p>
                                    <p style="font-size: 20px;line-height: 1.8;">
                                        Configuration – <?= $details_restaurant[0]['pConfiguration']; ?></p>

                                    <div class="sidebar-wrapper" style="margin-top: 3rem;max-width: 100%;margin-left: auto;">
                                        <div class="single-sidebar">
                                            <div class="sidebar-title">
                                                <h1 class="title">Related Projects</h1>
                                            </div>
                                            <ul class="recent-post">
                                                <?php foreach ($all_restaurant as $value) { ?>
                                                    <li>
                                                        <div class="img-holder">
                                                            <?php
                                                            // $sql1 = "SELECT MP_Id AS id, MPI_Images, MP_Id FROM mov_portfolio_images GROUP BY MP_Id";
                                                            $sql1 = "SELECT MPI_Images, MP_Id FROM mov_portfolio_images where MP_Id = '$value->MP_Id'";
                                                            // $sql1 = "select * from mov_portfolio_images where MP_Id = '$value->MP_Id'";
                                                            $r1 = $this->db->query($sql1);
                                                            $t = $r1->result();
                                                            foreach ($t as $valuemg) {
                                                                // print_r($valuemg->MP_Id);
                                                            ?>
                                                                <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/<?php echo $valuemg->MPI_Images; ?>" alt="Awesome Image">
                                                            <?php } ?>
                                                            <div class="overlay-style-one">
                                                                <div class="box">
                                                                    <div class="content">
                                                                        <a href="<?= $value->purl; ?>"><span class="icon-link"></span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="title-holder">
                                                            <h5 class="post-title"><a href="<?= $value->purl; ?>"><?= $value->MP_Name; ?></a></h5>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="tel: +91 950 30 33775" class="btn-one" type="submit">Call Us Now<span class="flaticon-next"></span></a>
                                        </div>
                                    </div>
                                </div>

                                

                            </div>
                        </div>
                        <!--End prev next option-->
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
<!--End blog single area-->

 <!--Start footer area-->
 <footer class="footer-area">
            <div class="footer-shape-bg wow slideInRight" data-wow-delay="300ms" data-wow-duration="2500ms"></div>
            <div class="container">
                <div class="row">
                    <!--Start single footer widget-->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="single-footer-widget marbtm50">
                            <div class="contact-info-box">
                                <div class="footer-logo" style="padding-bottom: 14px;">
                                    <a href="<?= base_url(); ?>">
                                        <img src="<?= base_url(); ?>assets/images/footer/footer-logo.png" alt="Awesome Logo" style="width: 32%;">
                                    </a>
                                </div>
                                <ul>
                                    <li>
                                        <h6>Address</h6>
                                        <p>Marigold, Row House # 2, Lane 8, Veerbhadra Nagar, Baner, Pune, Maharashtra 411045</p>
                                    </li>
                                    <li>
                                        <h6>Phone</h6>
                                        <p>+91 950 30 33775<br> <span>Mon - Sat:</span> 10 Am to 7 Pm</p>
                                    </li>
                                    <li>
                                        <h6>Email</h6>
                                        <p>Support@oglinginches.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End single footer widget-->
                    <!--Start single footer widget-->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="single-footer-widget marbtm50">
                            <div class="title">
                                <h3>Services</h3>
                            </div>
                            <div class="services-links">
                                <ul>
                                    <li><a href="<?= base_url(); ?>residential-interior">Residential</a></li>
                                    <li><a href="<?= base_url(); ?>restaurant-design">Restaurant</a></li>
                                    <li><a href="<?= base_url(); ?>commercial-interior">Commercial</a></li>
                                    <li><a href="<?= base_url(); ?>architecture">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End single footer widget-->
                    <!--Start single footer widget-->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="single-footer-widget pdbtm50">
                            <div class="title">
                                <h3>Recent Blog</h3>
                            </div>
                            <ul class="recent-news">
                                
                                <li>
                                    <div class="img-holder">
                                        <img src="https://oglinginches.com/blog/wp-content/uploads/2021/06/wood-for-home.jpg" alt="Awesome Image">
                                        <div class="overlay-style-one">
                                            <div class="box">
                                                <div class="content">
                                                    <a href="https://oglinginches.com/blog/top-10-types-of-good-quality-wood-for-your-home-furniture/"><span class="icon-next"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="title-holder">
                                        <h5><a href="https://oglinginches.com/blog/top-10-types-of-good-quality-wood-for-your-home-furniture/">Top 10 Types of Good Quality ...</a></h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-holder">
                                        <img src="https://oglinginches.com/blog/wp-content/uploads/2021/05/10-Tips-to-Choose-Right-Sofa-Layout-for-Your-Home.jpg" alt="Awesome Image">
                                        <div class="overlay-style-one">
                                            <div class="box">
                                                <div class="content">
                                                    <a href="https://oglinginches.com/blog/10-tips-to-choose-right-sofa-layout-for-your-home/"><span class="icon-next"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="title-holder">
                                        <h5><a href="https://oglinginches.com/blog/10-tips-to-choose-right-sofa-layout-for-your-home/">10 Tips to Choose Right Sofa ...</a></h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-holder">
                                        <img src="https://oglinginches.com/blog/wp-content/uploads/2021/06/Expensive-Brands-In-India.jpg" alt="oglinginches">
                                        <div class="overlay-style-one">
                                            <div class="box">
                                                <div class="content">
                                                    <a href="https://oglinginches.com/blog/top-5-most-expensive-brands-in-india-not-to-be-missed-looking-at/"><span class="icon-next"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="title-holder">
                                        <h5><a href="https://oglinginches.com/blog/top-5-most-expensive-brands-in-india-not-to-be-missed-looking-at/">Top 5 Most Expensive Brands In India ...</a></h5>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!--End single footer widget-->
                    <!--Start single footer widget-->
                </div>
            </div>
        </footer>
        <!--End footer area-->

        <!--Start footer bottom area-->
        <section class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="footer-bottom-content flex-box-two">
                            <div class="copyright-text">
                                <p style="color:#4b4b4b;">© <?php echo date('Y'); ?> <a href="https://oglinginches.com/" style="color:#1e1e1e;">Oglinginches</a>. All Rights Reserved. Search Engine Optimization by <a href="https://www.movinnza.in/seo-company-pune" style="color:#1e1e1e;">Movinnza</a></p>
                            </div>
                            <div class="footer-social-links float-right">
                                <span>We are On:</span>
                                <ul class="sociallinks-style-one">
                                    <li class="wow slideInUp" data-wow-delay="0ms" data-wow-duration="1200ms">
                                        <a href="https://www.instagram.com/oglinginches/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                                        <a href="https://www.facebook.com/oglinginches"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="https://www.youtube.com/channel/UCvTAS9TBhVL6kMoPnJnUmgQ"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="https://in.linkedin.com/in/ogling-inches-design-architects-ba120535"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="https://twitter.com/prashantkulsh"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="https://www.houzz.in/professionals/interior-designers-and-decorators/ogling-inches-design-architects-pfvwin-pf~562488991"><i class="fa fa-link" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="https://in.pinterest.com/oglinginches/"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End footer bottom area-->

    </div>


    <div class="scroll-to-top-style2 scroll-to-target" data-target="html">
        <span class="fa fa-angle-up"></span>
    </div>



    <script src="<?= base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?= base_url(); ?>assets/js/appear.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-select.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/isotope.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.bootstrap-touchspin.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.countTo.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.easing.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.enllax.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.fancybox.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.mixitup.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.paroller.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/owl.js"></script>
    <script src="<?= base_url(); ?>assets/js/validation.js"></script>
    <script src="<?= base_url(); ?>assets/js/wow.js"></script>

    <!---
<script src="js/gmaps.js"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyB2uu6KHbLc_y7fyAVA4dpqSVM4w9ZnnUw"></script>
<script src="js/mapapi.js"></script> 
--->
    <script src="<?= base_url(); ?>assets/js/map-helper.js"></script>

    <script src="<?= base_url(); ?>assets/language-switcher/jquery.polyglot.language.switcher.js"></script>
    <script src="<?= base_url(); ?>assets/timepicker/timePicker.js"></script>
    <script src="<?= base_url(); ?>assets/html5lightbox/html5lightbox.js"></script>

    <!--Revolution Slider-->
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/main-slider-script.js"></script>

    <!-- thm custom script -->
    <script src="<?= base_url(); ?>assets/js/custom.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-65124562-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-65124562-2');
    </script>

</body>

</html>