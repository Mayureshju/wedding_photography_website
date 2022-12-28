<!doctype html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="icon" sizes="16x16" href="<?php echo base_url(); ?>assets/img/favicon.png">

    <!-- Title -->
    <?php if (isset($bloglist) && !empty($bloglist)) {
    foreach ($bloglist as $bloglistdata) { ?>
    <title> <?php echo $bloglistdata->APC_Post_seo_title; ?> </title>
      <meta name="description" content=" <?php echo $bloglistdata->APC_Post_seo_description; ?>" />
      <meta name="keywords" content=" <?php echo $bloglistdata->APC_Post_Name; ?> " />
      <?php if ($bloglistdata->APC_publish_status == 0) { ?>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
      <?php } ?>
  <?php }
  } ?>

    <?php include('header.php'); ?>
  
    <!--post-default-->
    <section class="section pt-55 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mb-20">
                    <!--Post-single-->
                    <?php if (isset($bloglist) && !empty($bloglist)) {
                    foreach ($bloglist as $bloglistdata) { 
                    
                    $secmname = '';

                    if(strpos($bloglistdata->MUM_ID, ',') !== false) {
                        $authlist = explode(',', $bloglistdata->MUM_ID);
                        $secmname = 'Second Author';
                    }
                    ?>
                    <div class="post-single">
                        <div class="post-single-image">
                            <img src="<?php echo IMAGE_PATH; ?>post-media/images/<?php echo $bloglistdata->APC_Post_featured_image; ?>" class="img-responsive" alt="<?php echo $bloglistdata->APC_Post_Name; ?>" title="<?php echo $bloglistdata->APC_Post_Name; ?>">
                        </div>
                        <div class="post-single-content">
                            <a href="#" class="categorie">travel</a> 
                            <h4><?php echo $bloglistdata->APC_Post_Name; ?> </h4>
                            <div class="post-single-info">
                                <ul class="list-inline">
                                    <li><a href="#"><img src="assets/img/author/1.jpg" alt=""></a></li>
                                    <li><a href="#">David Smith</a> </li>
                                    <li class="dot"></li>
                                    <li><?php echo date("d M Y", strtotime($bloglistdata->APC_CreatedDate)); ?></li>
                                    <li class="dot"></li>
                                    <li>3 comments</li>
                                </ul>
                            </div>
                        </div>
                  
                        <div class="post-single-body">
                            <?php echo $bloglistdata->APC_Post_content; ?>
                        </div>

                        <div class="post-single-footer">
                            <div class="tags">
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">Travel</a>
                                    </li>
                                    <li>
                                        <a href="#">Nature</a>
                                    </li>
                                    <li>
                                        <a href="#">tips</a>
                                    </li>
                                    <li>
                                        <a href="#">forest</a>
                                    </li>
                                    <li>
                                        <a href="#">beach</a>
                                    </li>
                                
                                </ul>
                            </div>
                            <div class="social-media">
                                <ul class="list-inline">
                                    <li>
                                        <a href="#" class="color-facebook">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-youtube">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-pinterest">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>                           
                        </div>
                    </div> <!--/-->
                    <?php }
                    } ?>

                    <!--next & previous-posts-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="widget">
                                <div class="widget-next-post">
                                    <div class="small-post">
                                        <div class="image">
                                            <a href="post-default.html">
                                            <img src="assets/img/latest/1.jpg" alt="...">
                                            </a>                                          
                                        </div>
                                        <div class="content">
                                            <div>
                                                <a class="link" href="post-default.html"><i class="arrow_left"></i>Preview post</a>
                                            </div>
                                            <a href="post-default.html">7 Healty Dinner Recipes for a Date Night at Home</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="widget">
                                <div class="widget-previous-post">
                                    <div class="small-post">
                                        <div class="image">
                                            <a href="post-default.html">
                                               <img src="assets/img/blog/2.jpg" alt="...">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div>
                                                <a class="link" href="post-default.html">
                                                    <span> Next post</span>
                                                    <span class="arrow_right"></span>
                                                </a>
                                            </div>
                                            <a href="post-default.html">How to Choose Outfits for Work for woman and men</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/-->

                    <!--widget-comments-->
                    <div class="widget mb-50">
                        <div class="title">
                            <h5>3 Comments</h5>
                        </div>
                        <ul class="widget-comments">
                            <li class="comment-item">
                                <img src="assets/img/user/1.jpg" alt="">
                                <div class="content">
                                    <ul class="info list-inline">
                                        <li>Mohammed Ali</li>
                                        <li class="dot"></li>
                                        <li> January 15, 2021</li>
                                    </ul>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus at doloremque adipisci eum placeat
                                        quod non fugiat aliquid sit similique!
                                    </p>
                                    <div><a href="#" class="link"> <i class="arrow_back"></i> Reply</a></div>
                                </div>
                            </li>
                            <li class="comment-item">
                                <img src="assets/img/author/1.jpg" alt="">
                                <div class="content">
                                    <ul class="info list-inline">
                                        <li>Simon Albert</li>
                                        <li class="dot"></li>
                                        <li> January 15, 2021</li>
                                    </ul>
                                                      
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus at doloremque adipisci eum placeat quod non
                                        fugiat aliquid sit similique!
                                    </p>
                                    <div>
                                        <a href="#" class="link">
                                            <i class="arrow_back"></i> Reply</a>
                                    </div>
                                </div>
                            </li>
                            <li class="comment-item">
                                <img src="assets/img/user/2.jpg" alt="">
                                <div class="content">
                               
                                    <ul class="info list-inline">
                                        <li>Adam bobly</li>
                                        <li class="dot"></li>
                                        <li> January 15, 2021</li>
                                    </ul>
                    
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus at doloremque adipisci eum placeat
                                        quod non fugiat aliquid sit similique!
                                    </p>

                                    <div>
                                        <a href="#" class="link">
                                            <i class="arrow_back"></i> Reply</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                       <!--Leave-comments-->
                        <div class="title">
                            <h5>Leave a Reply</h5>
                        </div>
                        <form class="widget-form" action="#" method="POST" id="main_contact_form">
                            <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                            <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                Your message was sent successfully.
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" required="required"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name*" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required="required">
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="form-group">
                                        <input type="text" name="website" id="website" class="form-control" placeholder="website">
                                    </div>
                                    <label>
                                        <input name="name" type="checkbox" value="1" required="required"> 
                                       <span>save my name , email and website in this browser for the next time I comment.</span>                                   
                                    </label>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn-custom">
                                        Post Comment
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 max-width">
                    <!--widget-author-->
                    <div class="widget">
                        <div class="widget-author">
                            <a href="#" class="image">
                                <img src="assets/img/author/1.jpg" alt="">
                            </a>
                            <h6>
                                <span>Hi, I'm David Smith</span>
                            </h6>
                            <p>

                            I'm David Smith, husband and father ,
                             I love Photography,travel and nature. I'm working as a writer and blogger with experience
                            of 5 years until now.
                        </p>
                    
                    
                            <div class="social-media">
                                <ul class="list-inline">
                                    <li>
                                        <a href="#" class="color-facebook">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-youtube">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="color-pinterest">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/-->

                    <!--widget-latest-posts-->
                    <div class="widget ">
                        <div class="section-title">
                            <h5>Latest Posts</h5>
                        </div>
                        <ul class="widget-latest-posts">
                            <li class="last-post">
                                <div class="image">
                                    <a href="post-default.html">
                                        <img src="assets/img/latest/1.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="nb">1</div>
                                <div class="content">
                                    <p><a href="post-default.html">5 Things I Wish I Knew Before Traveling to Malaysia</a></p>
                                    <small><span class="icon_clock_alt"></span> January 15, 2021</small>
                                </div>
                            </li>
                            <li class="last-post">
                                <div class="image">
                                    <a href="post-default.html">
                                    <img src="assets/img/latest/2.jpg" alt="...">
                                    </a> 
                                </div>
                                <div class="nb">2</div>
                                <div class="content">
                                    <p>
                                        <a href="post-default.html">Everything you need to know about visiting the Amazon.</a>
                                    </p>
                                    <small>
                                        <span class="icon_clock_alt"></span> January 15, 2021</small>
                                </div>
                            </li>
                            <li class="last-post">
                                <div class="image">
                                    <a href="post-default.html">
                                    <img src="assets/img/latest/3.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="nb">3</div>
                                <div class="content">
                                    <p>
                                        <a href="post-default.html">How to spend interesting vacation after hard work?</a>
                                    </p>
                                    <small>
                                        <span class="icon_clock_alt"></span> January 15, 2021</small>
                                </div>
                            </li>
                            <li class="last-post">
                                <div class="image">
                                    <a href="post-default.html">
                                     <img src="assets/img/latest/4.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="nb">4</div>
                                <div class="content">
                                    <p>
                                        <a href="post-default.html">10 Best and Most Beautiful Places to Visit in Italy</a>
                                    </p>
                                    <small>
                                        <span class="icon_clock_alt"></span> January 15, 2021</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--/-->
                   
                    <!--widget-categories-->
                    <div class="widget">
                        <div class="section-title">
                            <h5>Categories</h5>
                        </div>
                        <ul class="widget-categories">
                            <li>
                                <a href="#" class="categorie">Livestyle</a>
                                <span class="ml-auto">22 Posts</span>
                            </li>
                            <li>
                                <a href="#" class="categorie">Travel</a>
                                <span class="ml-auto">18 Posts</span>
                            </li>
                            <li>
                                <a href="#" class="categorie">Food</a>
                                <span class="ml-auto">14 Posts</span>
                            </li>
                            <li>
                                <a href="#" class="categorie">fashion</a>
                                <span class="ml-auto">10 Posts</span>
                            </li>
                        </ul>
                    </div><!--/-->
                    
                    <!--widget-instagram-->
                    <!-- <div class="widget">
                        <div class="section-title">
                            <h5>Instagram</h5>
                        </div>
                        <ul class="widget-instagram">
                            <li>
                                <a class="image" href="#">
                                    <img src="assets/img/instagram/1.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a class="image" href="#">
                                    <img src="assets/img/instagram/2.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a class="image" href="#">
                                    <img src="assets/img/instagram/3.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a class="image" href="#">
                                    <img src="assets/img/instagram/4.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a class="image" href="#">
                                    <img src="assets/img/instagram/5.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a class="image" href="#">
                                    <img src="assets/img/instagram/6.jpg" alt="">
                                </a>
                            </li>
                        </ul>
                            
                    </div> -->
                    <!--/-->

                    <!--widget-tags-->
                    <div class="widget">
                        <div class="section-title">
                            <h5>Tags</h5>
                        </div>
                        <div class="widget-tags">
                            <ul class="list-inline">
                                <li>
                                    <a href="#">Travel</a>
                                </li>
                                <li>
                                    <a href="#">Nature</a>
                                </li>
                                <li>
                                    <a href="#">tips</a>
                                </li>
                                <li>
                                    <a href="#">forest</a>
                                </li>
                                <li>
                                    <a href="#">beach</a>
                                </li>
                                <li>
                                    <a href="#">fashion</a>
                                </li>
                                <li>
                                    <a href="#">livestyle</a>
                                </li>
                                <li>
                                    <a href="#">healty</a>
                                </li>
                                <li>
                                    <a href="#">food</a>
                                </li>
                                <li>
                                    <a href="#">breakfast</a>
                                </li>
                        
                            </ul>
                        </div>
                    </div>
                    <!--/-->
                </div> 
            </div>
        </div>
    </section><!--/-->

    
    <!--newslettre-->
    <section class="newslettre">
        <div class="container-fluid">
            <div class="newslettre-width text-center">
                <div class="newslettre-info">
                    <h5>Subscribe to our Newslatter</h5>
                    <p> Sign up for free and be the first to get notified about new posts. </p>
                </div>
                <form action="#" class="newslettre-form">
                    <div class="form-flex">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your email adress" required="required">
                        </div>
                        <button class="submit-btn" type="submit">Subscribe</button>
                    </div>
                </form>
                <div class="social-icones">
                    <ul class="list-inline">
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>Facebook</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-twitter"></i>Twitter </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram"></i>Instagram </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!--footer-->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright">
                        <p>© Copyright 2021  <a href="#">AssiaGroupe</a>, All rights reserved.</p>
                    </div>
                    <div class="back">
                        <a href="#" class="back-top">
                            <i class="arrow_up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--Search-form-->
    <div class="search">
        <div class="container-fluid">
            <div class="search-width  text-center">
                <button type="button" class="close">
                    <i class="icon_close"></i>
                </button>
                <form class="search-form" action="#">
                    <input type="search" value="" placeholder="What are you looking for?">
                    <button type="submit" class="search-btn">search</button>
                </form>
            </div>
        </div>
    </div>
    <!--/-->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.5.0.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!-- JS Plugins  -->
    <script src="assets/js/ajax-contact.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/switch.js"></script>
    
    <!-- JS main  -->
    <script src="assets/js/main.js"></script>


</body>
</html>