<!doctype html>
<html lang="en">
<head>
	<!-- Font Google -->
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

<!-- CSS Plugins -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blog/all.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blog/elegant-font-icons.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blog/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blog/owl.carousel.css">

<!-- main style -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blog/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blog/custom.css">
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="icon" sizes="16x16" href="<?php echo base_url(); ?>assets/img/favicon.png">

    <!-- Title -->
    <title> Anuurag - Blog </title>

   <?php include('header.php'); ?>

    <!--masonry-layout-->
    <section class="section masonry-layout pt-45">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-columns">
                    <?php
                    $i=1;
                        if (isset($blogs)) {
                            foreach ($blogs as $val) { 
                            
                                if(($i % 2) == 0){ ?>
                                <!--Post-2-->
                                    <div class="card">
                                        <div class="post-card">
                                            <div class="post-card-image">
                                                <a href="<?php echo $val->APC_Post_seo_url; ?>">
                                                    <<img src="<?php echo IMAGE_PATH;?>post-media/images/<?php echo $val->APC_Post_featured_image;?>" alt="<?php echo $val->APC_Post_Name;?>" title="<?php echo $val->APC_Post_Name;?>">
                                                </a>
                    
                                            </div>
                                            <div class="post-card-content">
                                                <a href="blog-grid.html" class="categorie"><?php echo convert_commas_to_value('aow_post_category', 'APC_PostCat_Name', $val->APC_PostCat_ID, 'APC_PostCat_ID '); ?></a>
                                                <h5>
                                                    <a href="<?php echo $val->APC_Post_seo_url; ?>"><?php echo $val->APC_Post_Name; ?></a>
                                                </h5>
                                                <p><?php echo $val->APC_Post_Description;?>
                                                </p>
                                                <div class="post-card-info">
                                                    <ul class="list-inline">
                                                        <li>
                                                            <a href="#">
                                                                <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><?php echo convert_commas_to_value('mov_user_master', 'MUM_Full_name', $val->MUM_ID, 'MUM_ID'); ?></a>
                                                        </li>
                                                        <li class="dot"></li>
                                                        <li><?php echo date("d F Y", strtotime($val->APC_CreatedDate)); ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/-->

                        <?php }
                                else{
                        ?>
                        <!--Post-1-->
                        <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="<?php echo $val->APC_Post_seo_url; ?>">
                                        <img src="<?php echo IMAGE_PATH;?>post-media/images/<?php echo $val->APC_Post_featured_image;?>" alt="<?php echo $val->APC_Post_Name;?>" title="<?php echo $val->APC_Post_Name;?>">
                                    </a>
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie"> <?php echo convert_commas_to_value('aow_post_category', 'APC_PostCat_Name', $val->APC_PostCat_ID, 'APC_PostCat_ID '); ?></a>
                                    <h5>
                                        <a href="<?php echo $val->APC_Post_seo_url; ?>"><?php echo $val->APC_Post_Name; ?></a>
                                    </h5>
                                    <p><?php echo $val->APC_Post_Description;?>
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="#">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"><?php echo convert_commas_to_value('mov_user_master', 'MUM_Full_name', $val->MUM_ID, 'MUM_ID'); ?></a>
                                            </li>
                                            <li class="dot"></li>
                                            <li><?php echo date("d F Y", strtotime($val->APC_CreatedDate)); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/-->
        
                        
                        <?php }  }
                        }
                        ?>

                        <!--Post-3-->
                        <!-- <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="post-default.html">
                                        <img src="<?php echo base_url(); ?>assets/img/blog/24.jpg" alt="">
                                    </a>
        
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie">Food</a>
                                    <h5>
                                        <a href="post-default.html">Enjoy My Favourite Molten Chocolate Cake</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam atque ipsa laborum sunt distinctio...
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="author.html">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="author.html">David Smith</a>
                                            </li>
                                            <li class="dot"></li>
                                            <li>January 15, 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--/-->
        
                        <!--Post-4-->
                        <!-- <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="post-default.html">
                                        <img src="<?php echo base_url(); ?>assets/img/blog/7.jpg" alt="">
                                    </a>
        
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie">Food</a>
        
                                    <h5>
                                        <a href="post-default.html">How to make cokies with Chocolate for your kids?</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam atque ipsa laborum sunt distinctio...
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="author.html">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="author.html">David Smith</a>
                                            </li>
                                            <li class="dot"></li>
                                            <li>January 15, 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--/-->
        
                        <!--Post-5-->
                        <!-- <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="post-default.html">
                                        <img src="<?php echo base_url(); ?>assets/img/blog/27.jpg" alt="">
                                    </a>
        
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie">Livestyle</a>
                                    <h5>
                                        <a href="post-default.html">How to Choose Outfits for Work for woman and men</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam atque ipsa laborum sunt distinctio...
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="author.html">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt=""> </a>
                                            </li>
                                            <li>
                                                <a href="author.html">David Smith</a>
                                            </li>
                                            <li class="dot"></li>
                                            <li>January 15, 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--/-->
        
                        <!--Post-6-->
                        <!-- <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="post-default.html">
                                        <img src="<?php echo base_url(); ?>assets/img/blog/23.jpg" alt="">
                                    </a>
        
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie">Nature</a>
                                    <h5>
                                        <a href="post-default.html">Discovering the Natural History of Trinidad and Tobago</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam atque ipsa laborum sunt distinctio...
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="author.html">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="author.html">David Smith</a>
                                            </li>
                                            <li class="dot"></li>
                                            <li>January 15, 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--/-->
        
                        <!--Post-7-->
                        <!-- <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="post-default.html">
                                        <img src="<?php echo base_url(); ?>assets/img/blog/26.jpg" alt="">
                                    </a>
        
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie">Livestyle</a>
                                    <h5>
                                        <a href="post-default.html">Top 10 Fashion Trends from Spring/Summer 2021 Fashion Weeks</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam atque ipsa laborum sunt distinctio...
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="author.html">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="author.html">David Smith</a>
                                            </li>
                                            <li class="dot"></li>
                                            <li>January 15, 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--/-->
        
                        <!--Post-8-->
                        <!-- <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="post-default.html">
                                        <img src="<?php echo base_url(); ?>assets/img/blog/2.jpg" alt="">
                                    </a>
        
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie">Livestyle</a>
                                    <h5>
                                        <a href="post-default.html">20+ Cute Girly Outfits to Buy for the First Day of Winter</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam atque ipsa laborum sunt distinctio...
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="author.html">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="author.html">David Smith</a>
                                            </li>
                                            <li class="dot"></li>
                                            <li>January 15, 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--/-->
        
                        <!--Post-9-->
                        <!-- <div class="card">
                            <div class="post-card">
                                <div class="post-card-image">
                                    <a href="post-default.html">
                                        <img src="<?php echo base_url(); ?>assets/img/blog/1.jpg" alt="">
                                    </a>
        
                                </div>
                                <div class="post-card-content">
                                    <a href="blog-grid.html" class="categorie">food</a>
        
                                    <h5>
                                        <a href="post-default.html">5 five places must visit in turkey to relax from work</a>
                                    </h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam atque ipsa laborum sunt distinctio...
                                    </p>
                                    <div class="post-card-info">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="author.html">
                                                    <img src="<?php echo base_url(); ?>assets/img/author/1.jpg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="author.html">David Smith</a>
                                            </li>
                                            <li class="dot"></li>
                                            <li>January 15, 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--/-->
                        
                    </div>
                    <?php echo $this->pagination->create_links(); ?>

                    <!--pagination-->
                    <!-- <div class="pagination mt-30">
                        <ul class="list-inline">
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="arrow_carrot-2right"></i>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!--/-->
   
   <?php include('footer.php'); ?>
   </body>
</html>