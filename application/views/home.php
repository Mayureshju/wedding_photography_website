<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Photoghapher</title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="photographer." />
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- master stylesheet -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css?v=120721.0">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.theme.default.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/images/favicon/apple-touch-icon.png">
    <!-- <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/favicon/favicon-32x32.png" sizes="32x32"> -->
    <!-- <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/favicon/favicon-16x16.png" sizes="16x16"> -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/html5shiv.js"></script>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-65124562-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
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
                                        <img src="<?= base_url(); ?>assets/images/resources/newslog.jpg" alt="Oglinginches Logo" style="width:100%;">
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



        <!--Main Slider-->
        <section class="main-slider">
            <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper" data-source="gallery">
                <!-- <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                    <ul> -->

                <div id="carousel01" class="owl-carousel owl-theme">
                    <?php if ($homebanners) {
                        foreach ($homebanners as $banner) { ?>
                            <div class="item">
                                <img class="img-responsive" src="<?php echo base_url(); ?>ogli_admin/uploads/homebanner/<?= $banner->Mpg_home_banner; ?>">
                            </div>
                    <?php }
                    } ?>
                </div>
                <!-- </ul>
                </div> -->
            </div>
        </section>
        <!--End Main Slider-->

        <!--Start Highlights Area-->
        <section class="highlights-area">
            <div class="container">
                <div class="row">
                    <!--Start single highlight box-->
                    <div class="col-xl-3 col-lg-3">
                        <div class="single-highlight-box text-center wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1200ms">
                            <div class="icon-holder">
                                <!-- <span class="icon-concept"></span> -->
                                <span class="lnr lnr-camera"></span>
                            </div>
                            <div class="inner-content">
                                <div class="text">
                                    <h3>Photography</h3>
                                    <p>
                                       Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis, dolore.
                                    </p>
                                </div>
                                <a class="btn-one" href="<?= base_url(); ?>residential-interior">Read More<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--End single highlight box-->
                    <!--Start single highlight box-->
                    <div class="col-xl-3 col-lg-3">
                        <div class="single-highlight-box text-center wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1200ms">
                            <div class="icon-holder">
                                <!-- <span class="icon-scheme"></span> -->
                                <span class="lnr lnr-camera-video"></span>
                            </div>
                            <div class="inner-content">
                                <div class="text">
                                    <h3>Vedioghaphy</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores optio totam molestiae.
                                    </p>
                                </div>
                                <a class="btn-one" href="<?= base_url(); ?>restaurant-design">Read More<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--End single highlight box-->
                    <!--Start single highlight box-->
                    <div class="col-xl-3 col-lg-3">
                        <div class="single-highlight-box text-center wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1200ms">
                            <div class="icon-holder">
                                <span class="icon-cupboard"></span>
                            </div>
                            <div class="inner-content">
                                <div class="text">
                                    <h3>Editing</h3>
                                    <p>
                                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem distinctio harum nostrum?
                                    </p>
                                </div>
                                <a class="btn-one" href="<?= base_url(); ?>commercial-interior">Read More<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--End single highlight box-->

                    <!--Start single highlight box-->
                    <div class="col-xl-3 col-lg-3">
                        <div class="single-highlight-box text-center wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1200ms">
                            <div class="icon-holder">
                                <!-- <span class="icon-cupboard icon-architecture-and-city1"> -->

                                <!-- </span> -->
                                <span class="lnr lnr-picture"></span>
                            </div>
                            <div class="inner-content">
                                <div class="text">
                                    <h3>Album</h3>
                                    <p>
                                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis, dolorem? Facilis, atque!
                                    </p>
                                </div>
                                <a class="btn-one" href="<?= base_url(); ?>architecture">Read More<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--End single highlight box-->

                </div>
            </div>
        </section>
        <!--End Highlights Area-->

        <!--Start about area-->
        <section class="about-area" style="padding-bottom: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="about-text">
                            <div class="sec-title">
                                <p>About Ourself</p>
                                <h1 class="title">Photographer And Vediographer In Mumbai</h1>
                            </div>
                            <div class="inner-content">
                                <div class="text">
                                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident id hic pariatur commodi, labore aut doloremque facilis? Harum, facere inventore. Nesciunt a eligendi nisi quod!</p>
                                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum sed dicta, quaerat reiciendis tempore iste magnam laborum nam recusandae est nesciunt debitis?</p>
                                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi quod laboriosam ipsam optio nisi eaque quidem veniam maxime? Sequi, libero. Accusamus explicabo voluptatum ratione beatae eaque?</p>
                                    <p class="text-justify">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, modi. Optio, saepe delectus cumque exercitationem accusamus, voluptatibus possimus sequi molestias iusto ad, quo cupiditate commodi ipsa ab aspernatur eum ducimus!
                                    </p>
                                </div>
                                <div class="about-carousel-box owl-carousel owl-theme">
                                    <!--Start Single Box-->
                                    <div class="single-box">
                                        <div class="icon-holder">
                                            <span class="icon-target"></span>
                                        </div>
                                        <div class="text-holder">
                                            <h3>Mission Statement</h3>
                                            <p class="text-justify">By taking efforts from the root level, we deliver always creative and best for our customers.</p>
                                        </div>
                                    </div>
                                    <!--End Single Box-->
                                </div>

                            </div>
                        </div>
                    </div>
                    

            </div>
        </section>
        <!--End about Area-->

        <!--Start Working Area-->
        <section class="working-area" style="background-image:url(<?= base_url(); ?>assets/images/parallax-background/working-bg.jpg);">
            <div class="container">
                <div class="sec-title with-text max-width text-center wow fadeInDown" data-wow-delay="100ms" data-wow-duration="1200ms">
                    <!-- <p>Our Expertise</p> -->
                    <div class="title clr-white">OUR EXPERTISE</div>
                    <p class="bottom-text">Our dedication, transparency, and enriched domain knowledge have given us a blend of projects as follows:</p>
                </div>
                <div class="row">
                    <!--Start Single Working Box-->
                    <div class="col-xl-6 col-lg-6">
                        <div class="single-working-box wow fadeInDown" data-wow-delay="0ms">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="<?= base_url(); ?>assets/images/resources/photography.jpg" alt="Awesome Image">
                                    <div class="overlay-style-one"></div>
                                </div>
                            </div>
                            <div class="text-holder">
                                <div class="plus-icon-box"><span class="icon-plus"></span></div>
                                <div class="outer-box">
                                    <div class="icon">
                                        <div class="inner">
                                            <div class="box">
                                                <span class="icon-architecture-and-city1"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <h3><a href="<?= base_url(); ?>residential-interior" style="color:#cfac72;">Photoghaphy</a></h3>
                                        <p class="text-justify">Being one of the <a href="<?= base_url(); ?>">best photographer in mumbai</a>, Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, voluptate expedita nam excepturi qui esse.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Working Box-->
                    <!--Start Single Working Box-->
                    <div class="col-xl-6 col-lg-6">
                        <div class="single-working-box wow fadeInDown" data-wow-delay="400ms">
                            <div class="img-holder">
                                <div class="inner">
                                    <!-- <video src="<?= base_url(); ?>assets/images/resources/veio.mp4" alt="Awesome Image" width="570" height="383" autoplay type="vedio/mp4" control/> -->
                                    <video controls width="570" height="383" autoplay muted>
            <source src="<?= base_url(); ?>assets/images/resources/veio.mp4" type="video/mp4">
           
        </video>
                                    <div class="overlay-style-one"></div>
                                </div>
                            </div>
                            <div class="text-holder">
                                <div class="plus-icon-box"><span class="icon-plus"></span></div>
                                <div class="outer-box">
                                    <div class="icon">
                                        <div class="inner">
                                            <div class="box">
                                                <span class="icon-shop"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <h3><a href="<?= base_url(); ?>restaurant-design" style="color:#cfac72;">Vediography</a></h3>
                                        <p class="text-justify">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda velit ea fugiat aspernatur repudiandae! Fuga enim labore quisquam debitis deserunt officiis iusto possimus eveniet totam!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Working Box-->
                    <!--Start Single Working Box-->
                    <div class="col-xl-6 col-lg-6">
                        <div class="single-working-box wow fadeInDown" data-wow-delay="800ms">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="<?= base_url(); ?>assets/images/resources/edting.jpg" alt="Awesome Image">
                                    <div class="overlay-style-one"></div>
                                </div>
                            </div>
                            <div class="text-holder">
                                <div class="plus-icon-box"><span class="icon-plus"></span></div>
                                <div class="outer-box">
                                    <div class="icon">
                                        <div class="inner">
                                            <div class="box">
                                                <span class="icon-company"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <h3><a href="<?= base_url(); ?>commercial-interior" style="color:#cfac72;">Editing</h3>
                                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium provident porro consequuntur quibusdam deleniti nisi ut fuga, a, dolores iure ex tenetur fugiat minus excepturi sed explicabo ipsa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Working Box-->
                    <!--Start Single Working Box-->
                    <div class="col-xl-6 col-lg-6">
                        <div class="single-working-box wow fadeInDown" data-wow-delay="800ms">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="<?= base_url(); ?>assets/images/resources/album.jpg" alt="Awesome Image">
                                    <div class="overlay-style-one"></div>
                                </div>
                            </div>
                            <div class="text-holder">
                                <div class="plus-icon-box"><span class="icon-plus"></span></div>
                                <div class="outer-box">
                                    <div class="icon">
                                        <div class="inner">
                                            <div class="box">
                                                <span class="icon-company"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <h3><a href="<?= base_url(); ?>architecture" style="color:#cfac72;">Album</a></h3>
                                        <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque nulla nobis officiis exercitationem quibusdam. Rem pariatur nulla rerum eaque, fuga quis id quas dolores quaerat tempore, earum repudiandae!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Working Box-->
                </div>
            </div>
        </section>
        <!--End Working Area-->

        <!--Start Recently Project Area-->
        <section class="recently-project-area" style="padding: 66px 0px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="sec-title float-left">
                            <!-- <p>Projects</p> -->
                            <!-- <div class="title"><span>Our</span> Portfolio</div> -->
                            <div class="title">Our Portfolio</div>
                        </div>
                        <!-- <div class="more-project-button float-right">
                            <a class="btn-two" href="#">More Projects<span class="flaticon-next"></span></a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!--Start Main project area style2-->
                <section class="main-project-area style2" style="padding: 15px 0 15px;">
                    <div class="container">
                        <ul class="project-filter post-filter has-dynamic-filters-counter">
                            <li data-filter=".filter-item" class="active"><span class="filter-text">ALL</span></li>
                            <li data-filter=".Potrait"><span class="filter-text">Potrait</span></li>
                            <li data-filter=".landscape"><span class="filter-text">Landscape</span></li>
                            <li data-filter=".wide-angle"><span class="filter-text">wide-angle</span></li>
                            <li data-filter=".pre-wedding"><span class="filter-text">Pre-wedding</span></li>
                        </ul>
                        <div class="row filter-layout masonary-layout">
                            <!--Start single project item RESIDENTIAL-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item Potrait">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                            <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/1.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>residential-interior/western-hills"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single project item RESIDENTIAL-->
                            <!--Start single project item RESIDENTIAL-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item Potrait">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                            <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/2.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>residential-interior/legacy-2019"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single  project item RESIDENTIAL-->
                            <!--Start single project item RESTAURANT-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item mod landscape">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                        <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/3.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>restaurant-design/masemari-chinjabi-bavdhan"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single project item RESTAURANT-->
                            <!--Start single project item-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item mod landscape">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                        <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/4.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>restaurant-design/k-factory-baner"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single project item-->

                            <!--Start single project item commercial-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item mod wide-angle">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                        <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/5.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>commercial-interior/holy-nails-baner"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single project item commercial-->
                            <!--Start single project item commercial-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item mod wide-angle">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                        <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/6.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>commercial-interior/tejaswini-makeup-studio-baner"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single project item commercial-->

                            <!--Start single project item architecture-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item mod wide-angle">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                        <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/7.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>architecture"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single project item architecture-->
                            <!--Start single project item architecture-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item mod pre-wedding">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                        <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/8.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>architecture"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 filter-item mod pre-wedding">
                                <div class="single-project-style5">
                                    <div class="img-holder">
                                        <div class="inner">
                                        <img src="<?= base_url(); ?>ogli_admin/uploads/portfolio-images/new/9.jpg" alt="Awesome Image">
                                            <div class="overlay-box">
                                                <div class="box">
                                                    <div class="link">
                                                        <a href="<?= base_url(); ?>architecture"><span class="icon-out"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End single project item architecture-->
                        </div>
                    </div>
                </section>
                <!--End Main project area style2-->
            </div>
        </section>
        <!--End Recently Project Area-->

        <!--Start Working Process Area-->
        <section class="working-process-area">
            <div class="container">
                <div class="sec-title text-center">
                    <p>To Do good photography</p>
                    <div class="title">Our Photography Processes</div>
                </div>
                <div class="row">
                    <!--Start Single Working Process-->
                    <div class="col-xl-3 col-lg-3 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="single-working-process text-center">
                            <div class="top-box"><span>01</span></div>
                            <div class="inner" style="height: 24rem;">
                                <h3>Enquiry</h3>
                                <p>You send us your requirement through website or mail.</p>
                                <div class="icon-holder">
                                    <span class="icon-productive"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Working Process-->
                    <!--Start Single Working Process-->
                    <div class="col-xl-3 col-lg-3 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="single-working-process text-center">
                            <div class="top-box"><span>02</span></div>
                            <div class="inner" style="height: 24rem;">
                                <h3>Decide a Venue</h3>
                                <p>We suggest you best Venue for Photography.</p>
                                <div class="icon-holder">
                                    <span class="icon-document"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Working Process-->
                    <!--Start Single Working Process-->
                    <div class="col-xl-3 col-lg-3 wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms">
                        <div class="single-working-process text-center">
                            <div class="top-box"><span>03</span></div>
                            <div class="inner" style="height: 24rem;">
                                <h3>Photography and Editing</h3>
                                <p>We click best photos and editing of photos.</p>
                                <div class="icon-holder">
                                    <span class="icon-kitchen"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Start Single Working Process-->
                    <div class="col-xl-3 col-lg-3 wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms">
                        <div class="single-working-process text-center">
                            <div class="top-box"><span>04</span></div>
                            <div class="inner" style="height: 24rem;">
                                <h3>Handover The Album</h3>
                                <p>Timely quality Handover of Pictures, Vedios and Album</p>
                                <div class="icon-holder">
                                    <span class="icon-kitchen"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Working Process-->
                </div>
            </div>
        </section>
        <!--End Working Process Area-->

        <!--Start slogan area-->
        <section class="slogan-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content flex-box-two fix">
                            <div class="title float-left">
                                <h3>Wanna Work With Our Profesional Team? Make an Appointment.</h3>
                            </div>
                            <div class="button float-right">
                                <a class="btn-one" href="<?= base_url(); ?>contact-us">Make an Appointment<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End slogan area-->

        <!--Start Testimonial Area-->
        <section class="testimonial-area">

        <div class="container">
                    <div class="row">
                        <!-- <div class="col-md-12 text-center">
                            <h2 class="title-1" style="color: #fff; font-weight: 500;">Hear from our clients</h2>
                        </div> -->
                      
                       
                    </div>
                </div>


            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="sec-title float-left">
                            <p>Testimonials</p>
                            <div class="title">Clients Review</div>
                        </div>
                        <!-- <div class="more-reviews-button float-right">
                            <a class="btn-two" href="#">More Reviews<span class="flaticon-next"></span></a>
                        </div> -->
                    </div>
                </div>
                <div class="row">

                <div class="col-md-4 clientvid">
                           <iframe width="100%" height="210" src="https://www.youtube.com/embed/fADJ4UtqJh4" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-4 clientvid">
                            <iframe width="100%" height="210" src="https://www.youtube.com/embed/_SqwuksAQN8" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-4 clientvid">
                            <iframe width="100%" height="210" src="https://www.youtube.com/embed/CWEcuMYxZj4" allowfullscreen></iframe>
                        </div><br/>
                    <!--Start Single Testimonial Item-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="single-testimonial-item text-center">
                            <div class="quote-icon">
                                <span class="icon-quote1"></span>
                            </div>
                            <div class="inner-content" style="height: 34rem;">
                                <div class="client-info">
                                    <h3>Rutuja G.</h3>
                                    <!-- <span>California</span> -->
                                </div>
                                <div class="img-box">
                                    <img src="<?= base_url(); ?>assets/images/testimonial/Hemangi-P.jpg" alt="Awesome Image">
                                </div>
                                <div class="text-box">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt laborum facilis illo quidem eum consequuntur nobis. Nobis ab illum voluptatum tempore officia pariatur, deleniti, cupiditate facilis deserunt consectetur tempora optio!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Testimonial Item-->
                    <!--Start Single Testimonial Item-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="single-testimonial-item text-center">
                            <div class="quote-icon">
                                <span class="icon-quote1"></span>
                            </div>
                            <div class="inner-content" style="height: 34rem;">
                                <div class="client-info">
                                    <h3>Mr Mayuresh J</h3>
                                    <!-- <span>Los Angeles</span> -->
                                </div>
                                <div class="img-box">
                                    <img src="<?= base_url(); ?>assets/images/testimonial/Mr-Suresh-Sampat.jpg" alt="Awesome Image">
                                </div>
                                <div class="text-box">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim nesciunt dolorum distinctio laborum consequatur, quaerat provident perspiciatis repellendus? Nostrum error dolor ut, aliquid, doloribus sapiente quod veritatis, odit dolorem omnis nulla architecto qui eos sint.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Testimonial Item-->
                    <!--Start Single Testimonial Item-->
                    <div class="col-xl-4 col-lg-4">
                        <div class="single-testimonial-item text-center">
                            <div class="quote-icon">
                                <span class="icon-quote1"></span>
                            </div>
                            <div class="inner-content" style="height: 34rem;">
                                <div class="client-info">
                                    <h3>Jayesh Mungekar</h3>
                                    <!-- <span>Newyork City</span> -->
                                </div>
                                <div class="img-box">
                                    <img src="<?= base_url(); ?>assets/images/testimonial/Mr-P-Honrao.jpg" alt="Awesome Image">
                                </div>
                                <div class="text-box">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores dolorum cupiditate blanditiis assumenda impedit at magnam explicabo ea pariatur. Eius ex illum expedita temporibus at nobis autem eaque quod doloribus quidem! Libero illum aut sequi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single Testimonial Item-->
                    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-6e829aff-64b4-4455-a581-00dc9765a5b5"></div>
                </div>
            </div>
        </section>
        <!--End Testimonial Area-->

        <!--Start appointment Area-->
        <section class="appointment-area" style="background-image:url(<?= base_url(); ?>assets/images/resources/Make-A-Appointment-Image.png);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="map-content-box">
                            <div class="sec-title">
                                <p>Contact Details</p>
                                <div class="title">How Can We Help You?</div>
                            </div>
                            <div class="inner paroller">
                                <img src="<?= base_url(); ?>assets/images/resources/map.png" alt="Map">
                                <div class="overlay">
                                    <div class="single-location-box one wow zoomIn" data-wow-delay="100ms" data-wow-duration="1500ms">
                                        <div class="marker-box">
                                            <span class="icon-pin"></span>
                                        </div>
                                        <div class="location-info">
                                            <p>Marigold, Row House # 2, Lane 8, Veerbhadra Nagar, Baner,<br> Pune, Maharashtra 411045<br> +91 950 30 33775<br> Support@oglinginches.com</p>
                                        </div>
                                    </div>
                                    <div class="single-location-box two wow zoomIn" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="marker-box">
                                            <span class="icon-pin"></span>
                                        </div>
                                        <div class="location-info">
                                            <p>Marigold, Row House # 2, Lane 8, Veerbhadra Nagar, Baner,<br> Pune, Maharashtra 411045<br> +91 950 30 33775<br> Support@oglinginches.com</p>
                                        </div>
                                    </div>
                                    <div class="single-location-box three wow zoomIn" data-wow-delay="500ms" data-wow-duration="1500ms">
                                        <div class="marker-box">
                                            <span class="icon-pin"></span>
                                        </div>
                                        <div class="location-info">
                                            <p>Marigold, Row House # 2, Lane 8, Veerbhadra Nagar, Baner,<br> Pune, Maharashtra 411045<br> +91 950 30 33775<br> Support@oglinginches.com</p>
                                        </div>
                                    </div>
                                    <div class="single-location-box four wow zoomIn" data-wow-delay="700ms" data-wow-duration="1500ms">
                                        <div class="marker-box">
                                            <span class="icon-pin"></span>
                                        </div>
                                        <div class="location-info">
                                            <p>Marigold, Row House # 2, Lane 8, Veerbhadra Nagar, Baner,<br> Pune, Maharashtra 411045<br> +91 950 30 33775<br> Support@oglinginches.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="contact-form appointment-box wow slideInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="title-box">
                                <h2>Make Appointment</h2>
                                <span>Leave your information here and get reply from our expert in 24 hours, don’t hesitate to ask.</span>
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
                            <div class="appointment">
                                <form action="<?php echo base_url(); ?>Welcome/quick_contact_home" method="post">
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
        <!--End appointment Area-->

        <!--Start latest blog area-->
       
        <!--End latest blog area-->
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
                                    <li><a href="#">Photography</a></li>
                                    <li><a href="#">Vediography</a></li>
                                    <li><a href="#">Editing</a></li>
                                    <li><a href="#">Album</a></li>
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
    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
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

    <script type="text/javascript">
        $('#carousel01').owlCarousel({
            // stagePadding: 50,
            loop: true,
            // margin: 50,
            nav: false,
            dots: false,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            autoplay: true,
            // smartSpeed: 600,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1150: {
                    items: 1
                }
            }
        });
    </script>

</body>

</html>