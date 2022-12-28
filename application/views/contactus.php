<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>photography</title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="photo" />
    <!-- master stylesheet -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css?v=120721.0">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/responsive.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <!-- <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/favicon/favicon-16x16.png" sizes="16x16"> -->
   
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

        <div class="preloader"></div>

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
                                        <img src="<?= base_url(); ?>assets/images/resources/newslog.jpg" alt=" Logo" style="width:100%;">
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
                                                <li><a href="<?= base_url(); ?>photography">Photography</a></li>
                                                <li><a href="#">Vediography</a></li>
                                                <li><a href="#">Editing</a></li>
                                                <!-- <li><a href="<?= base_url(); ?>architecture">Architecture</a></li> -->
                                                <li><a href="<?= base_url(); ?>contact-us">Contact</a></li>
                                                <!-- <li><a href="<?= base_url(); ?>blog">Blog</a></li> -->
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
                                                <h3>Maharashtra, Mumbai</h3>
                                                <p>jogeshwari,datt tekdi</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-item">
                                            <div class="icon">
                                                <span class="icon-phone"></span>
                                            </div>
                                            <div class="text">
                                                <h3>+91 123 34 3443</h3>
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
                                                <h3>jayumungekar@gmail.com</h3>
                                                <p>Get a Free Quote</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="header-social-links-style1 float-right">
                                    <li class="wow slideInUp" data-wow-delay="0ms" data-wow-duration="1200ms">
                                        <a title="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <a title="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a title="instagram" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--End Main Header-->
   <!--Start breadcrumb area-->
        <section class="breadcrumb-area style2" style="background-position: center;background-image: url('<?php if(!empty($data[0]->Mpg_bnr_contact_banner)){ echo base_url(); ?>ogli_admin/uploads/pagesbanner/<?= $data[0]->Mpg_bnr_contact_banner;  } ?>')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content-box clearfix">
                            <div class="title-s2 text-center">
                                <span>Contact Us</span>
                                <h1>Get In Touch With Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End breadcrumb area-->

        <!--Start Contact Address Area-->
        <section class="contact-address-area" style="padding-bottom: 50px;">
            <div class="container">

           

                <div class="row">
                    <!--Start Single Contact Address Box-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="single-contact-address-box" style="height: 17rem;">
                            <span class="icon-global"></span>
                            <h3>Visit Our Office</h3>
                            <p>jogeshwari mumbai</p>
                        </div>
                    </div>
                    <!--End Single Contact Address Box-->
                    <!--Start Single Contact Address Box-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="single-contact-address-box" style="height: 17rem;">
                            <span class="icon-support1"></span>
                            <h3>Call Us</h3>
                            <p>+91 123 45 67890 <br><span>Mon - Sat:</span> 10 Am to 7 Pm</p>
                        </div>
                    </div>
                    <!--End Single Contact Address Box-->
                    <!--Start Single Contact Address Box-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="single-contact-address-box" style="height: 17rem;">
                            <span class="icon-shipping-and-delivery"></span>
                            <h3>Mail Us</h3>
                            <p>Jayumungekar@Gmail.Com</p>
                        </div>
                    </div>
                    <!--End Single Contact Address Box-->
                </div>
                <!-- <div class="row">
                    <div class="col-xl-12">
                        <div class="bottom-text text-center">
                            <p>We’re here to help with any question of our customers, <a href="faq.html">Go to FAQ’s</a></p>
                        </div>
                    </div>
                </div> -->
            </div>
        </section>
        <!--End Contact Address Area-->

        <!--Start contact form area-->
        <section class="contact-info-area" style="padding: 40px 0 40px;">
            <div class="container">
                <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 clearfix">
                        <div class="contact-form-image-box">
                            <img src="<?php if(!empty($data[0]->Mpg_bnr_contact_side_image)){ echo base_url(); ?>ogli_admin/uploads/pagesbanner/<?= $data[0]->Mpg_bnr_contact_side_image; } ?>" alt="Awesome Image">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                        <div class="contact-form">
                            <div class="sec-title with-text" style="    padding-bottom: 0;">
                                <p>Drop Us a Line</p>
                                <div class="title">Send Your Message</div>
                                <p class="bottom-text">If you have question or would like more information on our works, Please complete the form and we’ll aim get back to you with in 24 hours.</p>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <?php if (isset($_SESSION['success'])) {?>
                                        <div id="success-alert" class="alert alert-success">
                                            <?php echo $_SESSION['success']; ?>
                                        </div>
                                    <?php }?>
                                    <?php if (isset($_SESSION['failure'])) {?>
                                        <div id="success-alert" class="alert alert-danger">
                                            <?php echo $_SESSION['failure']; ?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="inner-box">
                                <form action="<?php echo base_url(); ?>Welcome/quick_contact" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-box">
                                                <input type="text" name="first_name" placeholder="First Name" required="">
                                                <div class="icon">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-box">
                                                <input type="text" name="last_name" placeholder="Last Name" required="">
                                                <div class="icon">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-box">
                                                <input type="email" name="email" placeholder="Email Address" required="">
                                                <div class="icon">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-box">
                                                <input type="text" name="phone" placeholder="Phone" required="">
                                                <div class="icon">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-box">
                                                <textarea name="message" placeholder="Your Message..." required=""></textarea>
                                                <div class="icon envelop">
                                                    <i class="fa fa-comment" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="button-box">
                                               <!--  <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value=""> -->
                                                <button class="btn-one" type="submit" name="submit" value="submit">Send Your Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        <!--End contact form area-->
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
                                        <img src="<?= base_url(); ?>assets/images/resources/newslog.jpg" alt="Oglinginches Logo" style="width: 32%;">
                                    </a>
                                </div>
                                <ul>
                                    <li>
                                        <h6>Address</h6>
                                        <p>Jogeshwar,datt tekdi</p>
                                    </li>
                                    <li>
                                        <h6>Phone</h6>
                                        <p>+91 000 00 00000<br> <span>Mon - Sat:</span> 10 Am to 8 Pm</p>
                                    </li>
                                    <li>
                                        <h6>Email</h6>
                                        <p>Jayumungekar@Gmail.Com</p>
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
                                    <li><a href="<?= base_url(); ?>residential-interior"f>Photography</a></li>
                                    <li><a href="<?= base_url(); ?>restaurant-design">Vediography</a></li>
                                    <li><a href="<?= base_url(); ?>commercial-interior">Editing</a></li>
                                    <li><a href="<?= base_url(); ?>architecture">Album</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End single footer widget-->
                    <!--Start single footer widget-->
                   
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
                                <p style="color:#eae6e6;">© <?php echo date('Y'); ?> <a href="#" style="color:#eae6e6;">Photography</a>. All Rights Reserved. Developed by <a href="https://instagram.com/_the_walking_dom?igshid=YmMyMTA2M2Y=" style="color:#eae6e6;">Webswizards</a></p>
                            </div>
                            <div class="footer-social-links float-right">
                                <span style="color:#eae6e6;">We are On:</span>
                                <ul class="sociallinks-style-one">
                                    <li class="wow slideInUp" data-wow-delay="0ms" data-wow-duration="1200ms">
                                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
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

    <!-- <script src="<?= base_url(); ?>assets/language-switcher/jquery.polyglot.language.switcher.js"></script> -->
    <!-- <script src="<?= base_url(); ?>assets/timepicker/timePicker.js"></script> -->
    <!-- <script src="<?= base_url(); ?>assets/html5lightbox/html5lightbox.js"></script> -->

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

 

</body>

</html>