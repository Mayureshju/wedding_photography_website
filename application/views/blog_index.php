<!doctype html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="icon" sizes="16x16" href="<?php echo base_url(); ?>assets/images/small_logo.png">

    <!-- Title -->
    <title> Blog </title>

   <?php $page='blog'; ?>

    <!--masonry-layout-->
    <section class="section masonry-layout pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-columns">
                    <?php
                    $i=1;
                        if (isset($blogs)) {
                            foreach ($blogs as $val) { 
                                 ?>
                                <div class="card">
                                    <div class="post-card">
                                        <div class="post-card-image">
                                            <a href="<?php echo base_url().$val->APC_Post_seo_url; ?>">
                                                <img src="<?php echo IMAGE_PATH;?>post-media/images/<?php echo $val->APC_Post_featured_image;?>" alt="<?php echo $val->APC_Post_Name;?>" title="<?php echo $val->APC_Post_Name;?>">
                                            </a>
                                        </div>
                                        <div class="post-card-content">
                                            <a href="#" class="categorie"><?php echo convert_commas_to_value('aow_post_category', 'APC_PostCat_Name', $val->APC_PostCat_ID, 'APC_PostCat_ID '); ?></a>
                                            <h5 class=" post-card-content cursive-font">
                                                <a class="txt-clr h5" href="<?php echo base_url().$val->APC_Post_seo_url; ?>"><?php echo $val->APC_Post_Name; ?></a>
                                            </h5>
                                            <p><?php echo $val->APC_Post_Description;?>
                                            </p>
                                            <div class="post-card-info">
                                                <ul class="list-inline">
                                                    <li>
                                                        <a href="#">
                                                            <img src="<?php echo base_url(); ?>assets/images/author/author.png" alt="Author Image">
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
                            
                        <?php }
                                
                        }
                        ?>

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